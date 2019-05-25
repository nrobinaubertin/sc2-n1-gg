-- group is a reserved keyword and this doesn't play nice with doctrine
ALTER TABLE "group" RENAME TO team;

-- Remove unused tables
DROP TABLE eventadjacency;
DROP TABLE message;
DROP TABLE period;
DROP TABLE rating;
DROP TABLE story;

-- Remove unused columns
ALTER TABLE "player" DROP COLUMN "dom_val";
ALTER TABLE "player" DROP COLUMN "dom_start_id";
ALTER TABLE "player" DROP COLUMN "dom_end_id";
ALTER TABLE "player" DROP COLUMN "current_rating_id";
ALTER TABLE "player" DROP COLUMN "mcnum";
ALTER TABLE "match" DROP COLUMN "rta_id";
ALTER TABLE "match" DROP COLUMN "rtb_id";
ALTER TABLE "match" DROP COLUMN "treated";
ALTER TABLE "match" DROP COLUMN "period_id";
ALTER TABLE "event" DROP COLUMN "lft";
ALTER TABLE "event" DROP COLUMN "rgt";

-- Add primary keys for the used tables
ALTER TABLE "player" ADD PRIMARY KEY (id);
ALTER TABLE "match" ADD PRIMARY KEY (id);
ALTER TABLE "earnings" ADD PRIMARY KEY (id);
ALTER TABLE "event" ADD PRIMARY KEY (id);

-- order matches players to always have the lower id on player a
-- this will help in match_row player ordering
UPDATE "match" SET
    pla_id = plb_id,
    plb_id = pla_id,
    sca = scb,
    scb = sca,
    rca = rcb,
    rcb = rca
    WHERE pla_id > plb_id;

-- Add some indexes
CREATE INDEX ON "match" (pla_id);
CREATE INDEX ON "match" (plb_id);
CREATE INDEX ON "earnings" (player_id);
CREATE INDEX ON "player" (race);
CREATE INDEX ON "player" (tag);
CREATE INDEX ON "match" ("offline");

-- drop rounds from matches, we're only interested in events
UPDATE match as m SET eventobj_id = (
    SELECT parent_id FROM event WHERE id = m.eventobj_id
) WHERE EXISTS (
    SELECT id FROM event WHERE id = m.eventobj_id AND "type" = 'round'
);
UPDATE match as m SET eventobj_id = (
    SELECT parent_id FROM event WHERE id = m.eventobj_id
) WHERE EXISTS (
    SELECT id FROM event WHERE id = m.eventobj_id AND "type" = 'round'
);
UPDATE match as m SET eventobj_id = (
    SELECT parent_id FROM event WHERE id = m.eventobj_id
) WHERE EXISTS (
    SELECT id FROM event WHERE id = m.eventobj_id AND "type" = 'round'
);
UPDATE match as m SET eventobj_id = (
    SELECT parent_id FROM event WHERE id = m.eventobj_id
) WHERE EXISTS (
    SELECT id FROM event WHERE id = m.eventobj_id AND "type" = 'round'
);
UPDATE match as m SET eventobj_id = (
    SELECT parent_id FROM event WHERE id = m.eventobj_id
) WHERE EXISTS (
    SELECT id FROM event WHERE id = m.eventobj_id AND "type" = 'round'
);
UPDATE match as m SET eventobj_id = (
    SELECT parent_id FROM event WHERE id = m.eventobj_id
) WHERE EXISTS (
    SELECT id FROM event WHERE id = m.eventobj_id AND "type" = 'round'
);
UPDATE match as m SET eventobj_id = (
    SELECT parent_id FROM event WHERE id = m.eventobj_id
) WHERE EXISTS (
    SELECT id FROM event WHERE id = m.eventobj_id AND "type" = 'round'
);
UPDATE match as m SET eventobj_id = (
    SELECT parent_id FROM event WHERE id = m.eventobj_id
) WHERE EXISTS (
    SELECT id FROM event WHERE id = m.eventobj_id AND "type" = 'round'
);
DELETE FROM event WHERE "type" = 'round';
