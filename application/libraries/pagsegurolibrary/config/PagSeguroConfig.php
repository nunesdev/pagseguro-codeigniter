<?php

/*
 ************************************************************************
 PagSeguro Config File
 ************************************************************************
 */
 
$CI = & get_instance();
$config = $CI->config->item('pagseguro');
 
$PagSeguroConfig = array();

$PagSeguroConfig['environment'] = $config['environment']; // production, sandbox

$PagSeguroConfig['credentials'] = array();
$PagSeguroConfig['credentials']['email'] = "";
$PagSeguroConfig['credentials']['token']['production'] = "";
$PagSeguroConfig['credentials']['token']['sandbox'] = "";

$PagSeguroConfig['application'] = array();
$PagSeguroConfig['application']['charset'] = "UTF-8"; // UTF-8, ISO-8859-1

$PagSeguroConfig['log'] = array();
$PagSeguroConfig['log']['active'] = false;
$PagSeguroConfig['log']['fileLocation'] = "";
