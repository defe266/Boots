EJEMPLO DE USO CON EL MÁXIMO NÚMERO DE CAMPOS:

	$prefix = 'custom_';
	
	$custom_meta_fields = array(
		array(
			'label'	=> 'Text Input',
			'desc'	=> 'A description for the field.',
			'id'	=> $prefix.'text',
			'type'	=> 'text'
		),
		array(
			'label'	=> 'Textarea',
			'desc'	=> 'A description for the field.',
			'id'	=> $prefix.'textarea',
			'type'	=> 'textarea'
		),
		array(
			'label'	=> 'Checkbox Input',
			'desc'	=> 'A description for the field.',
			'id'	=> $prefix.'checkbox',
			'type'	=> 'checkbox'
		),
		array(
			'label'	=> 'Select Box',
			'desc'	=> 'A description for the field.',
			'id'	=> $prefix.'select',
			'type'	=> 'select',
			'options' => array (
				'one' => array (
					'label' => 'Option One',
					'value'	=> 'one'
				),
				'two' => array (
					'label' => 'Option Two',
					'value'	=> 'two'
				),
				'three' => array (
					'label' => 'Option Three',
					'value'	=> 'three'
				)
			)
		),
		array (
			'label'	=> 'Radio Group',
			'desc'	=> 'A description for the field.',
			'id'	=> $prefix.'radio',
			'type'	=> 'radio',
			'options' => array (
				'one' => array (
					'label' => 'Option One',
					'value'	=> 'one'
				),
				'two' => array (
					'label' => 'Option Two',
					'value'	=> 'two'
				),
				'three' => array (
					'label' => 'Option Three',
					'value'	=> 'three'
				)
			)
		),
		array (
			'label'	=> 'Checkbox Group',
			'desc'	=> 'A description for the field.',
			'id'	=> $prefix.'checkbox_group',
			'type'	=> 'checkbox_group',
			'options' => array (
				'one' => array (
					'label' => 'Option One',
					'value'	=> 'one'
				),
				'two' => array (
					'label' => 'Option Two',
					'value'	=> 'two'
				),
				'three' => array (
					'label' => 'Option Three',
					'value'	=> 'three'
				)
			)
		),
		array(
			'label'	=> 'Category',
			'id'	=> 'category',
			'type'	=> 'tax_select'
		),
		array(
			'label'	=> 'Post List',
			'desc'	=> 'A description for the field.',
			'id'	=>  $prefix.'post_id',
			'type'	=> 'post_list',
			'post_type' => array('post','page')
		),
		array(
			'label'	=> 'Date',
			'desc'	=> 'A description for the field.',
			'id'	=> $prefix.'date',
			'type'	=> 'date'
		),
		array(
			'label'	=> 'Slider',
			'desc'	=> 'A description for the field.',
			'id'	=> $prefix.'slider',
			'type'	=> 'slider',
			'min'	=> '0',
			'max'	=> '100',
			'step'	=> '5'
		),
		array(
			'label'	=> 'Image',
			'desc'	=> 'A description for the field.',
			'id'	=> $prefix.'image',
			'type'	=> 'image'
		),
		array(
			'label'	=> 'Repeatable',
			'desc'	=> 'A description for the field.',
			'id'	=> $prefix.'repeatable',
			'type'	=> 'repeatable'
		)
	);
	
	$My_meta_box = new My_meta_box('id','titulo','page','normal','high',$custom_meta_fields);