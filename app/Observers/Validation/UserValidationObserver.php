<?php  namespace App\Observers\Validation;

    class UserValidationObserver extends ValidationObserver {

        protected $rules = [
            'username'  => 'required|alpha_dash|unique:users,username|min:2|max:20',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|alpha_dash|min:6|max:64',
            'password_confirmation' => 'same:password',
        ];

        /**
         * Set conditional rules against the model.
         * @param Eloquent $model [description]
         */
        protected function setConditionalRules(\Eloquent $model){
            $id = $model->getKey();

            foreach(['email', 'username'] as $field){

                //Only use the rules if the correspoding field has been passed through.
                $this->validator->sometimes($field, $this->rules[$field].",$id", function($input) use($model, $field){
                    
                    //If the model already exists then we don't want to run specific validation.
                    if($model->exists){
                        
                        //Filter out specific rule
                        $this->validator->setRules(array_except($this->validator->getRules(), [$field]));
                        return true;
                    }
                    return false;
                });
            }

        }

    }

