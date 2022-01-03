<?php

use Phinx\Migration\AbstractMigration;

class InitializeJoomlaV405 extends AbstractMigration
{
    public function up()
    {
        $sql =
            file_get_contents(
                __DIR__ .
                '/../dumps/' .
                pathinfo(__FILE__, PATHINFO_FILENAME) .
                '.sql'
            );
        $this->query($sql);
    }

    public function down()
    {
        $jdb = JFactory::getDbo();
        $opts = $this->adapter->getOptions();
        $tbls =
            $jdb->setQuery("SHOW TABLES LIKE '%{$opts['table_prefix']}%';")
                ->loadColumn();

        $sql = "
            SET foreign_key_checks = 0;
            DROP TABLE " . implode(',', $tbls) . ";
            SET foreign_key_checks = 1;
        ";
        $this->execute($sql);
    }
}
