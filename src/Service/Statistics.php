<?php

namespace App\Service;

use App\Entity\Player as PlayerEntity;
use App\Entity\Match as MatchEntity;
use App\Entity\Earnings as EarningsEntity;
use Doctrine\ORM\EntityManagerInterface;

class Statistics
{
    public function getMatchesResults(array $matches, PlayerEntity $player = null, array $options = []): array
    {
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

        // count matches to avoid speding too much time on event grouping
        $match_grouped = 0;
        foreach ($matches as $match) {
            if (
                isset($options["group_by_event"])
                && $options["group_by_event"]
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
                    }
                }
            }

            // aggregate statistics about matches
            $datestring = strtotime($match->getDate()->format('Y-m').'-01')*1000;
            $results["matches_month"][$datestring]['total_matches'] += 1;

            if ($player) {
                if ($match->getPla()->getId() == $player->getId()) {
                    $race = strtolower($match->getPlb()->getRace());
                    $results["maps"][$race]["total"] += $match->getSca() + $match->getScb();
                    $results["maps"][$race]["wins"] += $match->getSca();
                    $results["matches"][$race]["total"]++;
                    if ($match->getSca() > $match->getScb()) {
                        $results["matches"][$race]["wins"]++;
                        $results["matches_month"][$datestring]['total_wins'] += 1;
                    }
                } else {
                    $race = strtolower($match->getPla()->getRace());
                    $results["maps"][$race]["total"] += $match->getSca() + $match->getScb();
                    $results["maps"][$race]["wins"] += $match->getSca();
                    $results["matches"][$race]["total"]++;
                    if ($match->getSca() < $match->getScb()) {
                        $results["matches"][$race]["wins"]++;
                        $results["matches_month"][$datestring]['total_wins'] += 1;
                    }
                }
            }
        }

        $results["match_grouped"] = $match_grouped;

        return $results;
    }
}
