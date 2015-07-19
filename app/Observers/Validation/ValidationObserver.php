<?php namespace App\Observers\Validation;

class ValidationObserver {

	/**
	 * @type object
	 * Our validator factory object
	 */
	protected $validator;

	/**
	 * @type array
	 * The rules we want to define 
	 */
	protected $rules = array();

	/**
	 * The custom messages we want to define. 
	 * @var array
	 */
	protected $messages = array();

	/**
	 * Store the instance of the validator factory
	 */
	public function __construct(\Illuminate\Validation\Factory $validator) { 
		$this->validator = $validator->make([], $this->rules, $this->messages);
	}

	/**
	 * A hook to the saving observer event
	 */
	public function saving(\Eloquent $model){
		//If there are errors the event should return false so the event flow is halted. 
		return $this->validate($model)->errors ? false : true;
    }

    public function validate(\Eloquent $model){
		$this->validator->setData($model->getAttributes());

        $this->setConditionalRules($model);

        if($this->validator->fails()){
        	//Here we set any validation error responses to the error field on the model.
            $model->setAttribute('errors', $this->validator->errors());
            return $model;
        } else{
        	return $model;
        }
    }

    protected function setConditionalRules(\Eloquent $model){}
}