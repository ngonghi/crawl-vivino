<?php

namespace Fuel\Migrations;

class Create_databases
{
    function up()
    {
        \DBUtil::create_table('countries', array(
            'countries_id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
            'name' => array('type' => 'varchar', 'constraint' => 255),
            'created_at' => array('type' => 'timestamp'),
            'updated_at' => array('type' => 'timestamp'),
        ), array('countries_id'));

        \DBUtil::create_table('wineries', array(
            'vivino_winery_id' => array('constraint' => 11, 'type' => 'int'),
            'winery' => array('type' => 'varchar', 'constraint' => 255),
            'created_at' => array('type' => 'timestamp'),
            'updated_at' => array('type' => 'timestamp'),
        ), array('vivino_winery_id'));

        \DBUtil::create_table('regions', array(
            'vivino_region_id' => array('constraint' => 11, 'type' => 'int'),
            'wine_region' => array('type' => 'varchar', 'constraint' => 255),
            'wine_region_text' => array('type' => 'text'),
            'created_at' => array('type' => 'timestamp'),
            'updated_at' => array('type' => 'timestamp'),
        ), array('vivino_region_id'));

        \DBUtil::create_table('vintages', array(
            'vivino_vintage_id' => array('constraint' => 11, 'type' => 'int'),
            'name' => array('type' => 'varchar', 'constraint' => 255),
            'year' => array('type' => 'int', 'constraint' => 5),
            'price' => array('type' => 'FLOAT', 'constraint' => 10),
            'grapes' => array('type' => 'varchar', 'constraint' => 255),
            'regional_style' => array('type' => 'varchar', 'constraint' => 255),
            'food_pairing' => array('type' => 'varchar', 'constraint' => 255),
            'image' => array('type' => 'varchar', 'constraint' => 255),
            'rating_value' => array('type' => 'FLOAT', 'constraint' => 10),
            'rating_count' => array('type' => 'int', 'constraint' => 11),
            'vivino_wineriy_id' => array('type' => 'int', 'constraint' => 11),
            'vivino_region_id' => array('type' => 'int', 'constraint' => 11),
            'countries_id' => array('type' => 'int', 'constraint' => 11),
            'vivino_wine_id' => array('type' => 'int', 'constraint' => 11),
            'created_at' => array('type' => 'timestamp'),
            'updated_at' => array('type' => 'timestamp'),
        ),
            array('vivino_vintage_id'),
            array(
                array
                (
                    'key' => 'vivino_wineriy_id',
                    'reference' => array(
                        'table' => 'wineries',
                        'column' => 'vivino_winery_id'
                    )
                ),
                array
                (
                    'key' => 'vivino_region_id',
                    'reference' => array(
                        'table' => 'regions',
                        'column' => 'vivino_region_id'
                    )
                ),
                array
                (
                    'key' => 'countries_id',
                    'reference' => array(
                        'table' => 'countries',
                        'column' => 'countries_id'
                    )
                )
            )
        );

        \DBUtil::create_table('crawl_statuses', array(
            'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
            'vivino_vintage_id' => array('type' => 'int', 'constraint' => 11),
            'status' => array('type' => 'int', 'constraint' => 4),
            'error_count' => array('type' => 'int', 'constraint' => 4),
            'error_message' => array('type' => 'varchar', 'constraint' => 255),
            'crawled_on' => array('type' => 'timestamp'),
            'created_at' => array('type' => 'timestamp'),
            'updated_at' => array('type' => 'timestamp'),
        ), array('id'),
           array(
               array(
               'key' => 'vivino_vintage_id',
               'reference' => array(
                   'table' => 'vintages',
                   'column' => 'vivino_vintage_id'
               )
               )
           )
        );

        \DBUtil::create_table('server_status', array(
            'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
            'server_ip' => array('type' => 'varchar', 'constraint' => 255),
            'access_url' => array('type' => 'varchar', 'constraint' => 255),
            'crawled_on' => array('type' => 'timestamp'),
            'reg_date' => array('type' => 'timestamp'),
            'active' => array('type' => 'int','constraint' => 4, 'default' => 0),
        ), array('id'));
    }

    function down()
    {
        \DBUtil::drop_table('countries');
        \DBUtil::drop_table('wineries');
        \DBUtil::drop_table('regions');
        \DBUtil::drop_table('vintages');
        \DBUtil::drop_table('crawl_statuses');
        \DBUtil::drop_table('server_status');
    }
}