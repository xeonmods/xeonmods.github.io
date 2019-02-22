<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Utility\Text;
use App\Purple\PurpleProjectSettings;
use Carbon\Carbon;

class CustomPagesTable extends Table
{
	public function initialize(array $config)
	{
		$this->setTable('custom_pages');
		$this->setPrimaryKey('id');
		$this->belongsTo('Admins')
		     ->setForeignKey('admin_id')
             ->setJoinType('INNER');
        $this->belongsTo('Pages')
	 		 ->setForeignKey('page_id')
	         ->setJoinType('INNER');
    }
    public function beforeSave($event, $entity, $options)
    {
    	$purpleSettings = new PurpleProjectSettings();
		$timezone       = $purpleSettings->timezone();
		$date           = Carbon::now($timezone);

		if ($entity->isNew()) {
			$entity->created  = $date;
		}
		else {
			$entity->modified = $date;
		}
	}
}