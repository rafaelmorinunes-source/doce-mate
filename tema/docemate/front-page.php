<?php
/**
 * Página inicial da Doce Mate.
 *
 * Substitui a home padrão do WordPress (que mostra as últimas postagens do
 * blog). Enquanto não houver produtos cadastrados, as seções de vitrine se
 * escondem sozinhas em vez de aparecerem vazias — e voltam automaticamente
 * quando as peças forem entrando.
 *
 * @package docemate
 */

defined( 'ABSPATH' ) || exit;

$d        = docemate_dados_loja();
$loja_url = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/' );
$whats    = docemate_link_whatsapp();

get_header();
?>

<div id="primary" class="content-area dm-home">
	<main id="main" class="site-main" role="main">

		<?php // ---------- Abertura ---------- ?>
		<section class="dm-hero">
			<p class="dm-hero__eyebrow">Porto Alegre &middot; Rio Grande do Sul</p>
			<h1 class="dm-hero__titulo">Moda infantil de bairro, agora também online</h1>
			<p class="dm-hero__texto">
				A mesma loja de sempre, com a comodidade de comprar de casa.
				Você pode retirar na loja e experimentar na hora — se não servir,
				troca ali mesmo, sem frete e sem espera.
			</p>
			<p class="dm-hero__acoes">
				<a class="button alt" href="<?php echo esc_url( $loja_url ); ?>">Ver as peças</a>
				<?php if ( $whats ) : ?>
					<a class="button dm-botao-vazado" href="<?php echo esc_url( $whats ); ?>" target="_blank" rel="noopener">
						Tirar dúvida no WhatsApp
					</a>
				<?php endif; ?>
			</p>
		</section>

		<?php // ---------- O que a loja garante ---------- ?>
		<ul class="dm-garantias">
			<li>
				<strong>Retirada grátis na loja</strong>
				Experimente na hora e troque na mesma visita
			</li>
			<li>
				<strong>Troca em até 30 dias</strong>
				A primeira troca por tamanho é por nossa conta
			</li>
			<li>
				<strong>PIX com desconto</strong>
				Cartão em até 3x sem juros
			</li>
			<li>
				<strong>Frete grátis no RS</strong>
				Em compras acima de R$&nbsp;249
			</li>
		</ul>

		<?php
		// ---------- Categorias ----------
		$categorias = docemate_categorias_destaque();

		if ( $categorias ) :
			?>
			<section class="dm-secao">
				<h2 class="dm-secao__titulo">Escolha por idade</h2>
				<div class="dm-categorias">
					<?php foreach ( $categorias as $cat ) : ?>
						<a class="dm-categoria" href="<?php echo esc_url( get_term_link( $cat ) ); ?>">
							<?php
							$thumb_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );
							if ( $thumb_id ) {
								echo wp_get_attachment_image( $thumb_id, 'woocommerce_thumbnail', false, array( 'class' => 'dm-categoria__foto' ) );
							} else {
								echo '<span class="dm-categoria__foto dm-categoria__foto--vazia" aria-hidden="true"></span>';
							}
							?>
							<span class="dm-categoria__nome"><?php echo esc_html( $cat->name ); ?></span>
						</a>
					<?php endforeach; ?>
				</div>
			</section>
		<?php endif; ?>

		<?php
		// ---------- Vitrine em destaque ----------
		docemate_secao_produtos(
			'Nossos destaques',
			'[products limit="8" columns="4" visibility="featured"]',
			docemate_tem_produtos( array( 'featured' => true ) )
		);

		// ---------- Novidades ----------
		docemate_secao_produtos(
			'Chegou agora',
			'[products limit="8" columns="4" orderby="date" order="DESC"]',
			docemate_tem_produtos()
		);
		?>

		<?php // ---------- A loja ---------- ?>
		<section class="dm-sobre">
			<h2 class="dm-sobre__titulo">Uma loja de família, com jeito daqui</h2>
			<p>
				A Doce Mate nasceu em Porto Alegre e atende famílias gaúchas há
				anos. Escolhemos peça por peça pensando em como criança de verdade
				usa roupa: tecido que não irrita a pele, que aguenta lavagem e que
				a criança consegue vestir sozinha.
			</p>
			<p>
				Continuamos na loja física, com a mesma conversa de sempre. O site
				é só mais um jeito de chegar até a gente.
			</p>
			<?php
			$sobre = get_page_by_path( 'sobre' );
			if ( $sobre ) :
				?>
				<p><a class="dm-link-seta" href="<?php echo esc_url( get_permalink( $sobre ) ); ?>">Conheça nossa história</a></p>
			<?php endif; ?>
		</section>

		<?php // ---------- Dúvida de tamanho ---------- ?>
		<?php if ( $whats ) : ?>
			<section class="dm-ajuda">
				<h2 class="dm-ajuda__titulo">Na dúvida do tamanho?</h2>
				<p>
					Manda mensagem que a gente ajuda a escolher. É mais rápido que
					devolver depois — e a gente conhece as peças uma por uma.
				</p>
				<p>
					<a class="button alt" href="<?php echo esc_url( $whats ); ?>" target="_blank" rel="noopener">
						Chamar no WhatsApp
					</a>
				</p>
			</section>
		<?php endif; ?>

	</main>
</div>

<?php
get_footer();
