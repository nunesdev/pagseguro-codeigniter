# Integração pagseguro library, com codeigniter
`https://sandbox.pagseguro.uol.com.br/`

## Configuração
`sandbox` ou `production`<br/>
$config['pagseguro']['environment'] = 'production';  <br/>

 -------------------------- PRODUCTION -------------------------------------- 
$config['pagseguro']['production']['pagseguroAccount'] = ''; <br/>
$config['pagseguro']['production']['pagseguroToken'] = '';<br/>
$config['pagseguro']['production']['purchaserTest']['name']  = 'João Silva';<br/>
$config['pagseguro']['production']['purchaserTest']['ddd']  = '11';<br/>
$config['pagseguro']['production']['purchaserTest']['phone']  = '66666666';<br/>
$config['pagseguro']['production']['purchaserTest']['email'] = 'email_producao@email.com.br';<br/>
$config['pagseguro']['production']['purchaserTest']['pass']  = 'senha_producao';<br/>
 ---------------------- SANDBOX - AMBIENTE DE TESTE ------------------------- 
$config['pagseguro']['sandbox']['pagseguroAccount'] = '';<br/>
$config['pagseguro']['sandbox']['pagseguroToken'] = '';<br/>
$config['pagseguro']['sandbox']['purchaserTest']['name']  = 'João Silva';<br/>
$config['pagseguro']['sandbox']['purchaserTest']['ddd']  = '55';<br/>
$config['pagseguro']['sandbox']['purchaserTest']['phone']  = '55555555';<br/>
$config['pagseguro']['sandbox']['purchaserTest']['email'] = 'email_gerado_no_sandbox@sandbox.pagseguro.com.br';<br/>
$config['pagseguro']['sandbox']['purchaserTest']['pass']  = 'senha_sandbox';<br/>
 
 #---- CARTÃO DE CRÉDITO DE TESTES ---- <br/>
  Número : 4111111111111111<br/>
  Bandeira : Visa<br/>
  Válido: 12/2030<br/>
  CVV: 123  <br/>
