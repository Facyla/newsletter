<?php

	$guid = (int) get_input("guid");
	
	$html = get_input("html", "", false);
	$css = get_input("css", "", false);
	$template = get_input("template");
	
	if (!empty($guid)) {
		$entity = get_entity($guid);
	
		if (!empty($entity) && $entity->canEdit()) {
			if (elgg_instanceof($entity, "object", Newsletter::SUBTYPE)) {
				$entity->html = $html;
				$entity->css = $css;
				$entity->template = $template;
				
				system_message(elgg_echo("newsletter:action:template:success"));
			} else {
				register_error(elgg_echo("ClassException:ClassnameNotClass", array($guid, elgg_echo("item:object:" . Newsletter::SUBTYPE))));
			}
		} else {
			register_error(elgg_echo("InvalidParameterException:NoEntityFound"));
		}
	} else {
		register_error(elgg_echo("InvalidParameterException:MissingParameter"));
	}
	
	forward(REFERER);