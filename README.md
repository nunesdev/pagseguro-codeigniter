pagseguro-codeigniter
=====================

Integração pagseguro library, com codeigniter

# Configuração
`sandbox` ou `production`
$config['pagseguro']['environment'] = 'production';  
 -------------------------- PRODUCTION -------------------------------------- 
$config['pagseguro']['production']['pagseguroAccount'] = ''; 
$config['pagseguro']['production']['pagseguroToken'] = '';
$config['pagseguro']['production']['purchaserTest']['name']  = 'João Silva';
$config['pagseguro']['production']['purchaserTest']['ddd']  = '55';
$config['pagseguro']['production']['purchaserTest']['phone']  = '55555555';
$config['pagseguro']['production']['purchaserTest']['email'] = 'c88141653087448305056@sandbox.pagseguro.com.br';
$config['pagseguro']['production']['purchaserTest']['pass']  = 'eC6JdAd5P9WF9FLF';
 ---------------------- SANDBOX - AMBIENTE DE TESTE ------------------------- 
$config['pagseguro']['sandbox']['pagseguroAccount'] = '';
$config['pagseguro']['sandbox']['pagseguroToken'] = '';
$config['pagseguro']['sandbox']['purchaserTest']['name']  = 'João Silva';
$config['pagseguro']['sandbox']['purchaserTest']['ddd']  = '55';
$config['pagseguro']['sandbox']['purchaserTest']['phone']  = '55555555';
$config['pagseguro']['sandbox']['purchaserTest']['email'] = 'c88141653087448305056@sandbox.pagseguro.com.br';
$config['pagseguro']['sandbox']['purchaserTest']['pass']  = 'eC6JdAd5P9WF9FLF';
 ---- CARTÃO DE CRÉDITO DE TESTES ---- 
  Número : 4111111111111111
  Bandeira : Visa
  Válido: 12/2030
  CVV: 123  
