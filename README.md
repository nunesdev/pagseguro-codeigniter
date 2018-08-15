# Integração pagseguro library, com codeigniter

Cadastro Sandbox
https://sandbox.pagseguro.uol.com.br/

## Configuração
`sandbox` ou `production`<br/>

```dart
$config['pagseguro']['environment'] = 'production';  
 -------------------------- PRODUCTION -------------------------------------- 
$config['pagseguro']['production']['pagseguroAccount'] = ''; 
$config['pagseguro']['production']['pagseguroToken'] = '';
$config['pagseguro']['production']['purchaserTest']['name']  = 'João Silva';
$config['pagseguro']['production']['purchaserTest']['ddd']  = '11';
$config['pagseguro']['production']['purchaserTest']['phone']  = '66666666';
$config['pagseguro']['production']['purchaserTest']['email'] = 'email_producao@email.com.br';
$config['pagseguro']['production']['purchaserTest']['pass']  = 'senha_producao';

 ---------------------- SANDBOX - AMBIENTE DE TESTE ------------------------- 
$config['pagseguro']['sandbox']['pagseguroAccount'] = '';
$config['pagseguro']['sandbox']['pagseguroToken'] = '';
$config['pagseguro']['sandbox']['purchaserTest']['name']  = 'João Silva';
$config['pagseguro']['sandbox']['purchaserTest']['ddd']  = '55';
$config['pagseguro']['sandbox']['purchaserTest']['phone']  = '55555555';
$config['pagseguro']['sandbox']['purchaserTest']['email'] = 'email_gerado_no_sandbox@sandbox.pagseguro.com.br';
$config['pagseguro']['sandbox']['purchaserTest']['pass']  = 'senha_sandbox';
``` 
 #---- CARTÃO DE CRÉDITO DE TESTES ---- <br/>
  Número : 4111111111111111<br/>
  Bandeira : Visa<br/>
  Válido: 12/2030<br/>
  CVV: 123  <br/>
