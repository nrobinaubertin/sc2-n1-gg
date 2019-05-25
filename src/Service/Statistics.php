<?php

namespace App\Service;

use App\Entity\Player as PlayerEntity;
use App\Entity\Match as MatchEntity;
use App\Entity\Earnings as EarningsEntity;
use Doctrine\ORM\EntityManagerInterface;

class Statistics
{
    public function getMatchesResults(array $matches, array $options = []): array
    {
        $player = isset($options["player"]) ? $options["player"] : null;
        $results = [
            "matches" => [
                "p" => [
                    "wins" => 0,
                    "total" => 0,
                ],
                "t" => [
                    "wins" => 0,
                    "total" => 0,
                ],
                "z" => [
                    "wins" => 0,
                    "total" => 0,
                ],
                "r" => [
                    "wins" => 0,
                    "total" => 0,
                ],
                "s" => [
                    "wins" => 0,
                    "total" => 0,
                ],
            ],
            "maps" => [
                "p" => [
                    "wins" => 0,
                    "total" => 0,
                ],
                "t" => [
                    "wins" => 0,
                    "total" => 0,
                ],
                "z" => [
                    "wins" => 0,
                    "total" => 0,
                ],
                "r" => [
                    "wins" => 0,
                    "total" => 0,
                ],
                "s" => [
                    "wins" => 0,
                    "total" => 0,
                ],
            ],
            "matches_month" => [],
            "events" => [],
            "last" => null,
            "first" => null,
        ];

        if (empty($matches)) {
            return $results;
        }

        $results["last"] = $matches[0];
        $results["first"] = end($matches);
        $results["recent_matches"] = array_slice($matches, 0, 10);
        $results["total_matches"] = count($matches);

        if (isset($options["matches_month"]) && $options["matches_month"]) {
            // Prepare $matches_month keys
            $end = $matches[0]->getDate();
            $start = $curr = new \Datetime(end($matches)->getDate()->format('Y-m').'-01');
            while ($curr->getTimestamp() < $end->getTimestamp()) {
                $results["matches_month"][$curr->getTimestamp()*1000] = [
                    'total_matches' => 0,
                    'total_wins' => 0,
                ];
                $curr->modify('+1 month');
            }
        }

        // count matches to avoid speding too much time on event grouping
        $match_grouped = 0;
        $match_ungrouped = 0;
        $match_without_event = 0;
        foreach ($matches as $match) {
            if (
                isset($options["group_by_event"])
                && $options["group_by_event"]
                && ($match_ungrouped < 100) // if we go over 100 ungrouped matches, we can assume that we will not group anymore
            ) {
                $event = $match->getEventObj();
                if (!empty($event)) {
                    // create the event in the event list if it doesn't exists
                    if (
                        !isset($results["events"][$event->getId()])
                        && $match_grouped < 100
                    ) {
                        $results["events"][$event->getId()] = [
                            "date" => $event->getEarliest(),
                            "name" => $event->getFullName(),
                            "matches" => [],
                        ];
                    }
                    if (isset($results["events"][$event->getId()])) {
                        $results["events"][$event->getId()]["matches"][] = $match;
                        $match_grouped++;
                    } else {
                        // the match is ungrouped when we go over 100 matches grouped and his group doesn't exist
                        $match_ungrouped++;
                    }
                } else {
                    $results["events"][uniqid("no_event_")] = [
                        "date" => $match->getDate(),
                        "name" => "Unknown event",
                        "matches" => [$match],
                    ];
                    $match_without_event++;
                }
            }

            if (isset($options["matches_month"]) && $options["matches_month"]) {
                $datestring = strtotime($match->getDate()->format('Y-m').'-01')*1000;
                $results["matches_month"][$datestring]['total_matches'] += 1;
            }

            if ($player) {
                if ($match->getPla()->getId() == $player->getId()) {
                    $race = strtolower($match->getPlb()->getRace());
                    $results["maps"][$race]["total"] += $match->getSca() + $match->getScb();
                    $results["maps"][$race]["wins"] += $match->getSca();
                    $results["matches"][$race]["total"]++;
                    if ($match->getSca() > $match->getScb()) {
                        $results["matches"][$race]["wins"]++;
                        if (isset($options["matches_month"]) && $options["matches_month"]) {
                            $results["matches_month"][$datestring]['total_wins'] += 1;
                        }
                    }
                } else {
                    $race = strtolower($match->getPla()->getRace());
                    $results["maps"][$race]["total"] += $match->getSca() + $match->getScb();
                    $results["maps"][$race]["wins"] += $match->getSca();
                    $results["matches"][$race]["total"]++;
                    if ($match->getSca() < $match->getScb()) {
                        $results["matches"][$race]["wins"]++;
                        if (isset($options["matches_month"]) && $options["matches_month"]) {
                            $results["matches_month"][$datestring]['total_wins'] += 1;
                        }
                    }
                }
            } else {
                // aggregate statistics without player focus
                $racea = strtolower($match->getPla()->getRace());
                $raceb = strtolower($match->getPlb()->getRace());
                $results["maps"][$racea]["total"] += $match->getSca() + $match->getScb();
                $results["maps"][$raceb]["total"] += $match->getSca() + $match->getScb();
                $results["matches"][$racea]["total"]++;
                $results["matches"][$raceb]["total"]++;
                if ($match->getSca() > $match->getScb()) {
                    $results["maps"][$racea]["wins"] += $match->getSca();
                    $results["matches"][$racea]["wins"]++;
                } else {
                    $results["maps"][$raceb]["wins"] += $match->getScb();
                    $results["matches"][$raceb]["wins"]++;
                }
            }
        }

        $results["match_grouped"] = $match_grouped;
        $results["match_ungrouped"] = $match_ungrouped;
        $results["match_without_event"] = $match_without_event;

        return $results;
    }
}
