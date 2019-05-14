-- group is a reserved keyword and this doesn't play nice with doctrine
ALTER TABLE "group" RENAME TO team;

-- Add primary keys for the used tables
ALTER TABLE "player" ADD PRIMARY KEY (id);
ALTER TABLE "match" ADD PRIMARY KEY (id);
ALTER TABLE "earnings" ADD PRIMARY KEY (id);
ALTER TABLE "event" ADD PRIMARY KEY (id);

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
