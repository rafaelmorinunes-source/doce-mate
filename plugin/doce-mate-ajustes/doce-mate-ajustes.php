<?php
/**
 * Plugin Name: Ajustes Doce Mate
 * Description: Correções de loja que precisam sobreviver a troca de tema.
 * Version:     1.0.0
 * Author:      Doce Mate
 *
 * Por que um plugin e não o functions.php do tema: estes ajustes valem para a
 * loja, não para a aparência. Se o tema for trocado ou regerado, eles
 * continuam valendo.
 *
 * @package docemate
 */

defined( 'ABSPATH' ) || exit;

/**
 * Remove o título simples do WooCommerce nas páginas de categoria e da loja.
 *
 * O tema já imprime o próprio cabeçalho de categoria, com estilo. Os dois
 * juntos deixam o nome da categoria repetido no topo da página.
 *
 * Se um dia o tema deixar de imprimir o dele, comente esta linha para o
 * título do WooCommerce voltar.
 */
add_filter( 'woocommerce_show_page_title', '__return_false' );

/**
 * Tira o prefixo "Categoria:" do título de arquivo.
 *
 * O WordPress prefixa automaticamente o título de páginas de arquivo:
 * "Categoria: Menina", "Tag: verão". Numa loja isso lê como saída de sistema,
 * não como vitrine — o cliente sabe que está numa categoria pelo caminho que
 * percorreu até ali.
 *
 * Funciona quando o tema monta o título com get_the_archive_title(), que é o
 * caminho padrão. Se o prefixo continuar aparecendo, o tema monta o título de
 * outro jeito e a remoção precisa ser feita nele.
 */
add_filter( 'get_the_archive_title_prefix', '__return_empty_string' );
