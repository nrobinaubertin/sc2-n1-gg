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
