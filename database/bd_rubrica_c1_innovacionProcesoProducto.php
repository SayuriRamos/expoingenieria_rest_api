<?php
	// Include config.php file
	include_once '../config.php';

	// Create a class proyecto
	class db_c1ProcesoProducto extends Config {

	   public function fetch() {
	    $sql = 'SELECT MAX(tipoRubrica_id) as maximo from tipo_rubrica';
	    $stmt = $this->conn->prepare($sql);
	    $stmt->execute();
	    $rows = $stmt->fetchAll();
	    return $rows;
	  }

	  // Insert an user in the database
	  public function insert(
		$proyecto_id, $juez_id, 
		$calificacion,
        $observacion,
        $descripcion_contextoGeneral,
        $descripcion_explicacionConcepto,
        $descripcion_presentacionAudiovisual,
		$descripcion_calidadNarrativaDistracciones,
		$descripcion_calidadVideo,
        $descripcion_claridadfluidez,
        $descripcion_participacion,
		$descripcion_tiempoExposicion,
        $descripcion_funcionalidad,
        $descripcion_relacionFisicoTeorica,
		$descripcion_originalidad
	  ) {	

		//Insertar proyecto_juez
		//INSERT INTO `proyecto_juez` (`proyecto_id`, `juez_id`, `observacion`, `calificacion`) VALUES ('3', '1', 'muy bien ', '100') 
		$sql = 'INSERT INTO proyecto_juez(proyecto_id, juez_id, observacion, calificacion) 
					VALUES (:proyecto_id, :juez_id, :observacion, :calificacion)';
	    $stmt = $this->conn->prepare($sql);
	    $stmt->execute(['proyecto_id' => $proyecto_id, 'juez_id' => $juez_id, 'observacion' => $observacion, 'calificacion' => $calificacion]);

		//Insertar tipo_proyecto
		//INSERT INTO `tipo_rubrica` (`tipoRubrica_id`, `proyecto_id`, `juez_id`) VALUES (NULL, '3', '1') 
		$sql = 'INSERT INTO tipo_rubrica(proyecto_id, juez_id) 
					VALUES (:proyecto_id, :juez_id)';
	    $stmt = $this->conn->prepare($sql);
	    $stmt->execute(['proyecto_id' => $proyecto_id, 'juez_id' => $juez_id]);

		$data = $this->fetch();
        $tipoRubrica_id = $data[0]['maximo'];

		//Insertar en rubrica
		$sql = 'INSERT INTO rubrica_proyectoacademico(
			tipoRubrica_id, 
			calificacion_contextoGeneral, 
			descripcion_contextoGeneral, 
			descripcion_explicacionConcepto, 
			calificacion_explicacionConcepto, 
			descripcion_presentacionAudiovisual, 
			calificacion_presentacionAudiovisual,
			descripcion_calidadNarrativaDistracciones,
			calificacion_calidadNarrativaDistracciones,
			descripcion_calidadVideo ,
			calificacion_calidadVideo,
			descripcion_claridadfluidez, 
			calificacion_claridadfluidez, 
			descripcion_participacion, 
			calificacion_participacion, 
			descripcion_tiempoExposicion, 
			calificacion_tiempoExposicion, 
			descripcion_funcionalidad, 
			calificacion_funcionalidad, 
			descripcion_relacionFisicoTeorica, 
			calificacion_relacionFisicoTeorica, 
			descripcion_originalidad,
			calificacion_originalidad
			) 
					VALUES (
			:tipoRubrica_id, 
			:calificacion_contextoGeneral, 
			:descripcion_contextoGeneral, 
			:descripcion_explicacionConcepto, 
			:calificacion_explicacionConcepto, 
			:descripcion_presentacionAudiovisual, 
			:calificacion_presentacionAudiovisual,
			:descripcion_calidadNarrativaDistracciones,
			:calificacion_calidadNarrativaDistracciones,
			:descripcion_calidadVideo ,
			:calificacion_calidadVideo,
			:descripcion_claridadfluidez, 
			:calificacion_claridadfluidez, 
			:descripcion_participacion, 
			:calificacion_participacion, 
			:descripcion_tiempoExposicion, 
			:calificacion_tiempoExposicion, 
			:descripcion_funcionalidad, 
			:calificacion_funcionalidad, 
			:descripcion_relacionFisicoTeorica, 
			:calificacion_relacionFisicoTeorica, 
			:descripcion_originalidad,
			:calificacion_originalidad 
			)';
	    $stmt = $this->conn->prepare($sql);
	    $stmt->execute([
		 'tipoRubrica_id' => $tipoRubrica_id, 
		 'calificacion_contextoGeneral' => $calificacion_contextoGeneral,
		 'descripcion_contextoGeneral' => $descripcion_contextoGeneral,
		 'descripcion_explicacionConcepto' => $descripcion_explicacionConcepto,
		 'calificacion_explicacionConcepto' => $calificacion_explicacionConcepto,
		 'descripcion_presentacionAudiovisual' => $descripcion_presentacionAudiovisual,
		 'calificacion_presentacionAudiovisual' => $calificacion_presentacionAudiovisual,
		 'calificacion_presentacionAudiovisual' => $calificacion_presentacionAudiovisual,
		 'descripcion_calidadNarrativaDistracciones' => $descripcion_calidadNarrativaDistracciones,
		 'calificacion_calidadNarrativaDistracciones' => $calificacion_calidadNarrativaDistracciones,
		 'descripcion_calidadVideo' => $descripcion_calidadVideo,
		 'calificacion_calidadVideo' => $calificacion_calidadVideo,
		 'descripcion_claridadfluidez' => $descripcion_claridadcluidez,
		 'calificacion_claridadfluidez' => $calificacion_claridadfluidez,
		 'descripcion_participacion' => $descripcion_participacion,
		 'calificacion_participacion' => $calificacion_participacion,
		 'descripcion_tiempoExposicion' => $descripcion_tiempoExposicion,
		 'calificacion_tiempoExposicion' => $calificacion_tiempoExposicion,
		 'descripcion_funcionalidad' => $descripcion_funcionalidad,
		 'calificacion_funcionalidad' => $calificacion_funcionalidad,
		 'descripcion_relacionFisicoTeorica' => $descripcion_relacionFisicoTeorica,
		 'calificacion_relacionFisicoTeorica' => $calificacion_relacionFisicoTeorica,
		 'descripcion_originalidad' => $descripcion_originalidad,
		 'calificacion_originalidad' => $calificacion_originalidad
		]);
		return true;
	  }
	}


?>