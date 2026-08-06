<?php
/**
 * Doce Mate — tema filho do Storefront.
 *
 * @package docemate
 */

defined( 'ABSPATH' ) || exit;

/**
 * Carrega o CSS do tema filho depois do CSS do Storefront.
 */
function docemate_enqueue_styles() {
	wp_enqueue_style(
		'docemate-style',
		get_stylesheet_uri(),
		array( 'storefront-style' ),
		wp_get_theme()->get( 'Version' )
	);
}
add_action( 'wp_enqueue_scripts', 'docemate_enqueue_styles', 20 );

/**
 * Dados da loja, gerados por juridico/preencher.py a partir de
 * dados-da-loja.conf — a mesma fonte das páginas jurídicas, para que o CNPJ
 * do rodapé nunca fique diferente do CNPJ dos Termos de Uso.
 *
 * @return array
 */
function docemate_dados_loja() {
	static $dados = null;

	if ( null === $dados ) {
		$arquivo = get_stylesheet_directory() . '/dados-loja.php';
		$dados   = file_exists( $arquivo ) ? (array) include $arquivo : array();
	}

	return $dados;
}

/**
 * Avisa no painel se o arquivo de dados não veio junto com o tema.
 */
function docemate_aviso_dados_ausentes() {
	if ( docemate_dados_loja() || ! current_user_can( 'manage_options' ) ) {
		return;
	}

	echo '<div class="notice notice-warning"><p><strong>Doce Mate:</strong> ';
	echo 'o arquivo <code>dados-loja.php</code> não está no tema, então o rodapé ';
	echo 'está sem razão social, CNPJ e endereço — que o Decreto 7.962/2013 exige ';
	echo 'em todas as páginas. Rode <code>tema/build.sh</code> e reenvie o tema.';
	echo '</p></div>';
}
add_action( 'admin_notices', 'docemate_aviso_dados_ausentes' );

/**
 * Tira o crédito "Built with Storefront & WooCommerce" do rodapé.
 */
function docemate_remove_credito_storefront() {
	remove_action( 'storefront_footer', 'storefront_credit', 20 );
}
add_action( 'init', 'docemate_remove_credito_storefront' );

/**
 * Rodapé com os dados que a lei exige em todas as páginas.
 *
 * Decreto 7.962/2013 (Lei do E-commerce): razão social, CNPJ, endereço físico,
 * e-mail e telefone precisam estar visíveis em qualquer página da loja.
 */
function docemate_rodape_legal() {
	$d = docemate_dados_loja();

	if ( ! $d ) {
		return;
	}

	$endereco = trim( ( $d['endereco'] ?? '' ) . ', Porto Alegre / RS' );
	if ( ! empty( $d['cep'] ) ) {
		$endereco .= ' — CEP ' . $d['cep'];
	}

	$politicas = array(
		'Trocas e devoluções' => 'trocas-e-devolucoes',
		'Política de frete'   => 'politica-de-frete',
		'Privacidade'         => 'politica-de-privacidade',
		'Termos de uso'       => 'termos-de-uso',
	);

	echo '<div class="dm-rodape-legal">';

	if ( ! empty( $d['razao_social'] ) ) {
		echo '<span class="dm-rodape-legal__marca">' . esc_html( $d['razao_social'] ) . '</span>';
	}

	if ( ! empty( $d['cnpj'] ) ) {
		echo 'CNPJ ' . esc_html( $d['cnpj'] ) . '<br>';
	}

	echo esc_html( $endereco ) . '<br>';

	if ( ! empty( $d['whatsapp'] ) ) {
		echo 'WhatsApp ' . esc_html( $d['whatsapp'] );
	}

	if ( ! empty( $d['email'] ) ) {
		echo ! empty( $d['whatsapp'] ) ? ' &middot; ' : '';
		echo '<a href="mailto:' . esc_attr( $d['email'] ) . '">' . esc_html( $d['email'] ) . '</a>';
	}

	if ( ! empty( $d['horario_atendimento'] ) ) {
		echo '<br>Atendimento: ' . esc_html( $d['horario_atendimento'] );
	}

	echo '<ul class="dm-rodape-legal__politicas">';
	foreach ( $politicas as $rotulo => $slug ) {
		$pagina = get_page_by_path( $slug );
		if ( $pagina ) {
			echo '<li><a href="' . esc_url( get_permalink( $pagina ) ) . '">' . esc_html( $rotulo ) . '</a></li>';
		}
	}
	echo '</ul>';

	echo '</div>';
}
add_action( 'storefront_footer', 'docemate_rodape_legal', 20 );

/**
 * Quatro produtos por linha no computador.
 * O padrão do Storefront é 3, que deixa a vitrine com cara de vazia.
 */
function docemate_colunas_vitrine() {
	return 4;
}
add_filter( 'storefront_loop_columns', 'docemate_colunas_vitrine' );
add_filter( 'loop_shop_columns', 'docemate_colunas_vitrine' );

/**
 * 24 produtos por página — múltiplo de 4, então a última linha nunca fica torta.
 */
function docemate_produtos_por_pagina() {
	return 24;
}
add_filter( 'loop_shop_per_page', 'docemate_produtos_por_pagina', 20 );

/**
 * Link para o guia de tamanhos dentro da página do produto, logo acima do
 * seletor de tamanho.
 *
 * Dúvida de tamanho é o principal motivo de carrinho abandonado em moda
 * infantil, e cada troca evitada é frete que a loja não paga.
 */
function docemate_link_guia_tamanhos() {
	$pagina = get_page_by_path( 'guia-de-tamanhos' );

	if ( ! $pagina ) {
		return;
	}

	echo '<p class="dm-guia-tamanhos"><a href="' . esc_url( get_permalink( $pagina ) ) . '">';
	echo 'Consultar o guia de tamanhos';
	echo '</a></p>';
}
add_action( 'woocommerce_before_variations_form', 'docemate_link_guia_tamanhos' );

/**
 * Storefront mostra "Página inicial" nas migalhas de pão. "Início" é mais curto
 * e não quebra a linha no celular.
 */
function docemate_ajusta_migalhas( $args ) {
	$args['home'] = 'Início';
	return $args;
}
add_filter( 'woocommerce_breadcrumb_defaults', 'docemate_ajusta_migalhas' );
