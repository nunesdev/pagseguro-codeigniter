pagseguro-codeigniter
=====================

Integração pagseguro library, com codeigniter

# Configuração
`sandbox` ou `production`
$config['pagseguro']['environment'] = 'production';  <br/>

 -------------------------- PRODUCTION -------------------------------------- 
$config['pagseguro']['production']['pagseguroAccount'] = ''; <br/>
$config['pagseguro']['production']['pagseguroToken'] = '';<br/>
$config['pagseguro']['production']['purchaserTest']['name']  = 'João Silva';<br/>
$config['pagseguro']['production']['purchaserTest']['ddd']  = '55';<br/>
$config['pagseguro']['production']['purchaserTest']['phone']  = '55555555';<br/>
$config['pagseguro']['production']['purchaserTest']['email'] = 'c88141653087448305056@sandbox.pagseguro.com.br';<br/>
$config['pagseguro']['production']['purchaserTest']['pass']  = 'eC6JdAd5P9WF9FLF';<br/>
 ---------------------- SANDBOX - AMBIENTE DE TESTE ------------------------- 
$config['pagseguro']['sandbox']['pagseguroAccount'] = '';<br/>
$config['pagseguro']['sandbox']['pagseguroToken'] = '';<br/>
$config['pagseguro']['sandbox']['purchaserTest']['name']  = 'João Silva';<br/>
$config['pagseguro']['sandbox']['purchaserTest']['ddd']  = '55';<br/>
$config['pagseguro']['sandbox']['purchaserTest']['phone']  = '55555555';<br/>
$config['pagseguro']['sandbox']['purchaserTest']['email'] = 'c88141653087448305056@sandbox.pagseguro.com.br';<br/>
$config['pagseguro']['sandbox']['purchaserTest']['pass']  = 'eC6JdAd5P9WF9FLF';<br/>
 ---- CARTÃO DE CRÉDITO DE TESTES ---- <br/>
  Número : 4111111111111111<br/>
  Bandeira : Visa<br/>
  Válido: 12/2030<br/>
  CVV: 123  <br/>
