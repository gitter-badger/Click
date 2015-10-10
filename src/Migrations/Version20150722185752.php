<?php

namespace OctoLab\Click\Migrations;

use OctoLab\Common\Doctrine\Migration\DriverBasedMigration;

/**
 * @author Kamil Samigullin <kamil@samigullin.info>
 */
class Version20150722185752 extends DriverBasedMigration
{
    public function prePdoPgsqlUp()
    {
        $this->addSql('');
    }

    public function prePdoPgsqlDown()
    {
        $this->addSql('');
    }
}
