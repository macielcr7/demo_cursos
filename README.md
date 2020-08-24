# demo_cursos
demonstracao de cursos

pastas

	app:
		npm install 
		
		alterar o IP Setado para o IP local da maquina onde o apache vai rodar 
		nos arquivos

		- cursos/resources/android/xml/network_security_config.xml
		<domain includeSubdomains="true">192.168.10.103</domain>

		- cursos/src/services/api.services.ts
		public PARENT_BASE_API:string = 'http://192.168.10.103/ezoom/cursoV1/site/index.php/apiCursos/';

	site:
		chmod -R 775 uplods/
		trocar os dados de banco
		php composer.phar install
		importar o banco.sql
