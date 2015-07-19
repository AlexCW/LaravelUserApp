<?php 

namespace App\Storage;

use Illuminate\Database\Eloquent\Model;
	
abstract class EloquentRepository implements InterfaceRepository {

	/**
	 * The model that we will be accessing using Eloquent.
	 * @string $model
	 */
	protected $model;

	/**
	 * @param Eloquent $model 
	 */
	public function __construct(\Eloquent $model) {
		$this->model = $model;
	}	

	/**
	 * @param array $data
	 * @return boolean
	 */
	public function saveNew(array $data = array()) {
		$record = $this->model->create( $data );

		return array(
			'errors' => (!empty($record->errors) ? $record->errors->toArray() : ''), 
			'success' => empty($record->errors), 
			'response' => $record 
		);
	}

	/**
	 * Update an existing dataset
	 * @param array $identifier
	 * @param array $data
	 * @return boolean
	 */
	public function saveExisting( array $identifier, array $data = array() ) {
		$record = $this->model->where( $identifier )->first()->fill($data);
		$success = $record->update();
		
		return array(
			'errors' => (!empty($record->errors) ? $record->errors->toArray() : ''), 
			'success' => $success, 
			'response' => $record 
		);
	}
}