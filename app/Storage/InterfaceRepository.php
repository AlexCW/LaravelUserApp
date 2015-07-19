<?php

namespace App\Storage;

interface InterfaceRepository {
	public function saveNew( array $data = array() );
	public function saveExisting( array $identifier, array $data = array() );
}