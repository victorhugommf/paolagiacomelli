<?php

//Begin Really Simple SSL session cookie settings
@ini_set('session.cookie_httponly', true);
@ini_set('session.cookie_secure', true);
@ini_set('session.use_only_cookies', true);
//END Really Simple SSL
/**
 * As configurações básicas do WordPress
 *
 * O script de criação wp-config.php usa esse arquivo durante a instalação.
 * Você não precisa usar o site, você pode copiar este arquivo
 * para "wp-config.php" e preencher os valores.
 *
 * Este arquivo contém as seguintes configurações:
 *
 * * Configurações do MySQL
 * * Chaves secretas
 * * Prefixo do banco de dados
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/pt-br:Editando_wp-config.php
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar estas informações
// com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define('DB_NAME', 'u778319454_wp');

/** Usuário do banco de dados MySQL */
define('DB_USER', 'u778319454_wp');

/** Senha do banco de dados MySQL */
define('DB_PASSWORD', 'Saude@195');

/** Nome do host do MySQL */
define('DB_HOST', 'localhost');

/** Charset do banco de dados a ser usado na criação das tabelas. */
define('DB_CHARSET', 'utf8mb4');

/** O tipo de Collate do banco de dados. Não altere isso se tiver dúvidas. */
define('DB_COLLATE', '');

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las
 * usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org
 * secret-key service}
 * Você pode alterá-las a qualquer momento para invalidar quaisquer
 * cookies existentes. Isto irá forçar todos os
 * usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '~Y{,bbV0u`Z0xErpj9P n{:EO+P,/#r)sIV^&/_?>g8{suy_=z-vf.Ip@<<lpqbv');
define('SECURE_AUTH_KEY',  'f 6;A06K8y=A]7ky[|}w?TE7KT/nU$5r} 2$gdW:,5r6V&)Mh-<shJ$CK23~NF]8');
define('LOGGED_IN_KEY',    'k;`6tgi5_rm:|]2F7&h=VKJv@%6?#<BD`Cp_l#_H$,#< `iiNX{1I}q>Pd_:/JX&');
define('NONCE_KEY',        'By+guRpu?|k/E<HztH`F0MoP<jV6`mC:jCf];fFlD//GZN1W-5x*h9m`U7:>c|DH');
define('AUTH_SALT',        'O`7Pzwe85o5{VT4x~$p$:TIR*cG6A@N_?SI.b=[V[[E,y ~[G<[Q2Z:-Xg3~aE_|');
define('SECURE_AUTH_SALT', 'f,CB:f}yTxtQXT(c]jtW RMKjd)GD|#c)^pa(=L_ykC*>q/}X=6+NwD%^e=?D@a|');
define('LOGGED_IN_SALT',   '[_pF]L-6#mt!snu7V%>o5!rDdLvlT,.X-t_ 7p;F_VF8aKsNx)|xaGUyVX{)H!L;');
define('NONCE_SALT',       't#g?FkQXD+AvXI_?#=:dSX!W6[8XrY/Q^kPK %Wd1re~zyB1(9hMoSOB&k6Dm9Wa');

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der
 * um prefixo único para cada um. Somente números, letras e sublinhados!
 */
$table_prefix = 'wpstg0_'; // Changed by WP STAGING

/**
 * Para desenvolvedores: Modo de debug do WordPress.
 *
 * Altere isto para true para ativar a exibição de avisos
 * durante o desenvolvimento. É altamente recomendável que os
 * desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 *
 * Para informações sobre outras constantes que podem ser utilizadas
 * para depuração, visite o Codex.
 *
 * @link https://codex.wordpress.org/pt-br:Depura%C3%A7%C3%A3o_no_WordPress
 */
define('WP_DEBUG', false);

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
define('UPLOADS', 'wp-content/uploads'); 
define('WP_PLUGIN_DIR', __DIR__ . "/wp-content/plugins"); 
define('WP_PLUGIN_URL', 'https://paolagiacomelli.com.br/paolateste/wp-content/plugins'); 
define('WP_LANG_DIR', __DIR__ . "/wp-content/languages"); 
define('WP_HOME', 'https://paolagiacomelli.com.br/paolateste'); 
define('WP_SITEURL', 'https://paolagiacomelli.com.br/paolateste'); 
define('WP_ENVIRONMENT_TYPE', 'staging'); 
if ( ! defined( 'ABSPATH' ) )
	define('ABSPATH', dirname(__FILE__) . '/');
	
/*Habilitando cache para o Cache Enabler*/
define('WP_CACHE', false);

/** Configura as variáveis e arquivos do WordPress. */
require_once(ABSPATH . 'wp-settings.php');
