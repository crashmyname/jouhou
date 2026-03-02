<?php


use Bpjs\Framework\Helpers\SchemaBuilder;

class CreatePSkillTable
{
    public function up(\PDO $pdo)
    {
        $table = new SchemaBuilder('p_skill');
        $table->id('psId');
        $table->string('empName');
        $table->string('empNik');
        $table->string('profil');
        $table->string('pointSkill');
        $table->timestamp('created_at')->default('CURRENT_TIMESTAMP');
        $table->timestamp('updated_at')->default('CURRENT_TIMESTAMP');
        $sql = $table->buildCreateSQL();
        try {
             $pdo->exec($sql);
             echo "Table 'p_skill' berhasil dibuat\n";
        } catch (\PDOException $e) {
             echo "Gagal membuat tabel: ".$e->getMessage()."\n";
             echo "SQL:".$sql;
        }
    }

    public function down(PDO $pdo)
    {
        $table = new SchemaBuilder('p_skill');
        $pdo->exec($table->buildDropSQL());
    }
}
