# Plugin Ajustes Doce Mate

Correções de loja que precisam **sobreviver a troca de tema**.

## Instalar

```bash
./plugin/build.sh
```

Gera `plugin/doce-mate-ajustes.zip`. No WordPress:

**Plugins → Adicionar novo → Enviar plugin** → escolher o zip → Instalar →
**Ativar**.

Para atualizar depois, envie o zip de novo e confirme *Substituir pelo atual*.

## Por que plugin e não `functions.php`

Regra prática: **aparência vai no tema, comportamento da loja vai no plugin.**

Um ajuste no `functions.php` morre junto com o tema. Como o site já passou por
mais de um tema, qualquer correção posta lá vira trabalho refeito na próxima
troca. O que está aqui continua valendo.

## O que ele faz hoje

**Remove o título duplicado nas páginas de categoria.**

O tema imprime o próprio cabeçalho de categoria, com estilo, e o WooCommerce
imprime outro, simples. Os dois juntos repetem o nome da categoria no topo. O
plugin desliga o do WooCommerce e deixa o do tema.

**Tira o prefixo "Categoria:" do título.**

O WordPress prefixa títulos de arquivo automaticamente — "Categoria: Menina",
"Tag: verão". Numa vitrine isso lê como saída de sistema. O cliente já sabe
onde está pelo caminho que percorreu.

> O segundo ajuste depende de o tema montar o título com
> `get_the_archive_title()`, que é o caminho padrão. Se o prefixo continuar
> aparecendo, o tema monta o título de outro jeito, e aí a remoção precisa ser
> feita no código dele.

## O que ainda deveria estar aqui

O **rodapé com razão social, CNPJ, endereço e contato**, que o Decreto
7.962/2013 exige em todas as páginas da loja.

Hoje ele está no tema `tema/docemate/`, que não é mais o tema ativo — ou seja,
a loja está **sem esse bloco**. Ele deveria migrar para cá justamente por ser
obrigação legal, e não questão de aparência: precisa valer independentemente
do tema.
