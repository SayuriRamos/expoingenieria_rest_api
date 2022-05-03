<?php
	// Include config.php file
	include_once '../config.php';

	// Create a class proyecto
	class db_proyectoAcademico extends Config {

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
        $descripcion_presentacionFisica,
        $descripcion_presentacionAudiovisual,
        $descripcion_ClaridadFluidez,
        $descripcion_participacion,
        $descripcion_desarrolloSistPropios,
        $descripcion_originalidad,
        $descripcion_funcionalidad,
        $descripcion_relacionFisicoTeorica,
        $descripcion_tiempoRespuesta,
		$descripcion_tiempoExposicion,
        $descripcion_conceptoComunicacionVisualMensaje,
        $descripcion_diseno,
        $descripcion_organizacionElementos,
        $descripcion_disenoInterfaz,
        $calificacion_contextoGeneral,
        $calificacion_explicacionConcepto,
        $calificacion_presentacionFisica,
        $calificacion_presentacionAudiovisual,
        $calificacion_ClaridadFluidez,
        $calificacion_participacion,
        $calificacion_tiempoExposicion,
        $calificacion_desarrolloSistPropios,
        $calificacion_originalidad,
        $calificacion_funcionalidad,
        $calificacion_relacionFisicoTeorica,
        $calificacion_tiempoRespuesta,
        $calificacion_conceptoComunicacionVisualMensaje,
        $calificacion_diseno,
        $calificacion_organizacionElementos,
        $calificacion_disenoInterfaz
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
			descripcion_presentacionFisica, 
			calificacion_presentacionFisica, 
			descripcion_presentacionAudiovisual, 
			calificacion_presentacionAudiovisual, 
			descripcion_ClaridadFluidez, 
			calificacion_ClaridadFluidez, 
			descripcion_participacion, 
			calificacion_participacion, 
			descripcion_tiempoExposicion, 
			calificacion_tiempoExposicion, 
			descripcion_desarrolloSistPropios, 
			calificacion_desarrolloSistPropios, 
			descripcion_originalidad, 
			calificacion_originalidad, 
			descripcion_funcionalidad, 
			calificacion_funcionalidad, 
			descripcion_relacionFisicoTeorica, 
			calificacion_relacionFisicoTeorica, 
			descripcion_tiempoRespuesta, 
			calificacion_tiempoRespuesta, 
			descripcion_conceptoComunicacionVisualMensaje, 
			calificacion_conceptoComunicacionVisualMensaje, 
			descripcion_diseno, 
			calificacion_diseno, 
			descripcion_organizacionElementos, 
			calificacion_organizacionElementos, 
			descripcion_disenoInterfaz, 
			calificacion_disenoInterfaz) 
					VALUES (
			:tipoRubrica_id, 
			:calificacion_contextoGeneral, 
			:descripcion_contextoGeneral, 
			:descripcion_explicacionConcepto, 
			:calificacion_explicacionConcepto, 
			:descripcion_presentacionFisica, 
			:calificacion_presentacionFisica, 
			:descripcion_presentacionAudiovisual, 
			:calificacion_presentacionAudiovisual, 
			:descripcion_ClaridadFluidez, 
			:calificacion_ClaridadFluidez, 
			:descripcion_participacion, 
			:calificacion_participacion, 
			:descripcion_tiempoExposicion, 
			:calificacion_tiempoExposicion, 
			:descripcion_desarrolloSistPropios, 
			:calificacion_desarrolloSistPropios, 
			:descripcion_originalidad, 
			:calificacion_originalidad, 
			:descripcion_funcionalidad, 
			:calificacion_funcionalidad, 
			:descripcion_relacionFisicoTeorica, 
			:calificacion_relacionFisicoTeorica, 
			:descripcion_tiempoRespuesta, 
			:calificacion_tiempoRespuesta, 
			:descripcion_conceptoComunicacionVisualMensaje, 
			:calificacion_conceptoComunicacionVisualMensaje, 
			:descripcion_diseno, 
			:calificacion_diseno, 
			:descripcion_organizacionElementos, 
			:calificacion_organizacionElementos, 
			:descripcion_disenoInterfaz, 
			:calificacion_disenoInterfaz)';
	    $stmt = $this->conn->prepare($sql);
	    $stmt->execute([
		 'tipoRubrica_id' => $tipoRubrica_id, 
		 'calificacion_contextoGeneral' => $calificacion_contextoGeneral,
		 'descripcion_contextoGeneral' => $descripcion_contextoGeneral,
		 'descripcion_explicacionConcepto' => $descripcion_explicacionConcepto,
		 'calificacion_explicacionConcepto' => $calificacion_explicacionConcepto,
		 'descripcion_presentacionFisica' => $descripcion_presentacionFisica,
		 'calificacion_presentacionFisica' => $calificacion_presentacionFisica,
		 'descripcion_presentacionAudiovisual' => $descripcion_presentacionAudiovisual,
		 'calificacion_presentacionAudiovisual' => $calificacion_presentacionAudiovisual,
		 'descripcion_ClaridadFluidez' => $descripcion_ClaridadFluidez,
		 'calificacion_ClaridadFluidez' => $calificacion_ClaridadFluidez,
		 'descripcion_participacion' => $descripcion_participacion,
		 'calificacion_participacion' => $calificacion_participacion,
		 'descripcion_tiempoExposicion' => $descripcion_tiempoExposicion,
		 'calificacion_tiempoExposicion' => $calificacion_tiempoExposicion,
		 'descripcion_desarrolloSistPropios' => $descripcion_desarrolloSistPropios,
		 'calificacion_desarrolloSistPropios' => $calificacion_desarrolloSistPropios,
		 'descripcion_originalidad' => $descripcion_originalidad,
		 'calificacion_originalidad' => $calificacion_originalidad,
		 'descripcion_funcionalidad' => $descripcion_funcionalidad,
		 'calificacion_funcionalidad' => $calificacion_funcionalidad,
		 'descripcion_relacionFisicoTeorica' => $descripcion_relacionFisicoTeorica,
		 'calificacion_relacionFisicoTeorica' => $calificacion_relacionFisicoTeorica,
		 'descripcion_tiempoRespuesta' => $descripcion_tiempoRespuesta,
		 'calificacion_tiempoRespuesta' => $calificacion_tiempoRespuesta,
		 'descripcion_conceptoComunicacionVisualMensaje' => $descripcion_conceptoComunicacionVisualMensaje,
		 'calificacion_conceptoComunicacionVisualMensaje' => $calificacion_conceptoComunicacionVisualMensaje,
		 'descripcion_diseno' => $descripcion_diseno,
		 'calificacion_diseno' => $calificacion_diseno,
		 'descripcion_organizacionElementos' => $descripcion_organizacionElementos,
		 'calificacion_organizacionElementos' => $calificacion_organizacionElementos,
		 'descripcion_disenoInterfaz' => $descripcion_disenoInterfaz,
		 'calificacion_disenoInterfaz' => $calificacion_disenoInterfaz
		]);
		return true;
	  }
	}


?>