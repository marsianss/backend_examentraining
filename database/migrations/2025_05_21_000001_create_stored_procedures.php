<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateStoredProcedures extends Migration
{
    public function up()
    {
        // Skip stored procedures for SQLite (used in testing)
        if (config('database.default') === 'sqlite') {
            return;
        }
        // 1. Ophalen voertuigen voor instructeur
        DB::unprepared('
            CREATE PROCEDURE sp_GetVehiclesByInstructor(IN p_InstructeurId INT)
            BEGIN
                SELECT v.*, tv.Rijbewijscategorie
                FROM voertuig v
                INNER JOIN voertuig_instructeur vi ON v.Id = vi.VoertuigId
                INNER JOIN type_voertuig tv ON v.TypeVoertuigId = tv.Id
                WHERE vi.InstructeurId = p_InstructeurId
                ORDER BY tv.Rijbewijscategorie;
            END
        ');

        // 2. Wijzigen voertuiggegevens
        DB::unprepared('
            CREATE PROCEDURE sp_UpdateVehicle(
                IN p_Id INT,
                IN p_Type VARCHAR(255),
                IN p_Brandstof VARCHAR(255),
                IN p_Kenteken VARCHAR(20),
                IN p_Bouwjaar DATE,
                IN p_IsAssigned BOOLEAN
            )
            BEGIN
                IF p_IsAssigned THEN
                    UPDATE voertuig
                    SET Type = p_Type,
                        Brandstof = p_Brandstof,
                        Kenteken = p_Kenteken,
                        DatumGewijzigd = NOW()
                    WHERE Id = p_Id;
                ELSE
                    UPDATE voertuig
                    SET Type = p_Type,
                        Brandstof = p_Brandstof,
                        Kenteken = p_Kenteken,
                        Bouwjaar = p_Bouwjaar,
                        DatumGewijzigd = NOW()
                    WHERE Id = p_Id;
                END IF;
            END
        ');

        // 3. Hertoewijzen voertuig
        DB::unprepared('
            CREATE PROCEDURE sp_ReassignVehicle(
                IN p_VoertuigId INT,
                IN p_OldInstructeurId INT,
                IN p_NewInstructeurId INT
            )
            BEGIN
                UPDATE voertuig_instructeur
                SET InstructeurId = p_NewInstructeurId,
                    DatumToekenning = CURDATE(),
                    DatumGewijzigd = NOW()
                WHERE VoertuigId = p_VoertuigId
                AND InstructeurId = p_OldInstructeurId;
            END
        ');

        // 4. Ophalen beschikbare voertuigen
        DB::unprepared('
            CREATE PROCEDURE sp_GetAvailableVehicles()
            BEGIN
                SELECT v.*, tv.Rijbewijscategorie
                FROM voertuig v
                LEFT JOIN voertuig_instructeur vi ON v.Id = vi.VoertuigId
                INNER JOIN type_voertuig tv ON v.TypeVoertuigId = tv.Id
                WHERE vi.VoertuigId IS NULL
                ORDER BY tv.Rijbewijscategorie;
            END
        ');

        // 5. Ophalen instructeurs gesorteerd op sterren
        DB::unprepared('
            CREATE PROCEDURE sp_GetInstructeursSortedByStars()
            BEGIN
                SELECT i.*,
                       COUNT(vi.VoertuigId) as VoertuigCount
                FROM instructeur i
                LEFT JOIN voertuig_instructeur vi ON i.Id = vi.InstructeurId
                GROUP BY i.Id
                ORDER BY i.AantalSterren DESC;
            END
        ');

        // 6. Toewijzen nieuw voertuig aan instructeur
        DB::unprepared('
            CREATE PROCEDURE sp_AssignVehicleToInstructor(
                IN p_VoertuigId INT,
                IN p_InstructeurId INT
            )
            BEGIN
                INSERT INTO voertuig_instructeur (
                    VoertuigId,
                    InstructeurId,
                    DatumToekenning,
                    IsActief,
                    DatumAangemaakt,
                    DatumGewijzigd
                ) VALUES (
                    p_VoertuigId,
                    p_InstructeurId,
                    CURDATE(),
                    1,
                    NOW(),
                    NOW()
                );
            END
        ');
    }

    public function down()
    {
        // Skip stored procedures for SQLite (used in testing)
        if (config('database.default') === 'sqlite') {
            return;
        }
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_GetVehiclesByInstructor');
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_UpdateVehicle');
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_ReassignVehicle');
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_GetAvailableVehicles');
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_GetInstructeursSortedByStars');
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_AssignVehicleToInstructor');
    }
}
