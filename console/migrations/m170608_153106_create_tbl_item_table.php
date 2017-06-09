<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_item`.
 */
class m170608_153106_create_tbl_item_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_item', [
            'id' => $this->primaryKey(),
            'item_reference'=>$this->string()->unique()->notNull(),
            'item_name'=>$this->string(200)->notNull(),
            'year'=>$this->char(5),
            'description'=>$this->text()->notNull(),
            'shelve_id'=>$this->integer(),
            'status'=>$this->char(1),
            'maker_id'=>$this->string(200),
            'maker_time'=>$this->dateTime(),
        ]);
        // creates index for column `branch_id`
        $this->createIndex(
            'idx-tbl_item-shelve_id',
            'tbl_item',
            'shelve_id'
        );


        // add foreign key for table `tbl_branch`
        $this->addForeignKey(
            'fk-tbl_item-shelve_id',
            'tbl_item',
            'shelve_id',
            'tbl_shelve',
            'id',
            'RESTRICT'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey(
            'fk-tbl_item-shelve_id',
            'tbl_item'
        );

        // drops index for column `branch_id`
        $this->dropIndex(
            'idx-tbl_item-shelve_id',
            'tbl_item'
        );
        $this->dropTable('tbl_item');
    }
}