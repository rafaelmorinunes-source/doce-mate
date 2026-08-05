# 4. Fotos e cadastro de produtos

Esta é a etapa que mais dá trabalho e a que mais determina se a loja vende.
Site bonito com foto ruim não vende; site simples com foto boa vende.

---

## 4.1 Fotos

### O mínimo por peça

- **1 foto frontal** em fundo neutro (branco ou bem claro)
- **1 foto das costas**
- **1 detalhe** — estampa, botão, bordado, acabamento
- **1 foto em uso** — criança vestindo, se possível

A foto em uso é a que mais converte em moda infantil. Mãe compra imaginando a
criança dela na peça. Foto só de peça esticada na mesa não cria essa imagem.

### Como fotografar sem equipamento

O celular resolve. O que importa é:

1. **Luz natural, perto da janela, sem sol direto.** Manhã ou fim de tarde.
   Nunca use o flash — ele achata a peça e distorce a cor
2. **Fundo liso.** Um lençol branco esticado ou uma parede clara basta
3. **Sempre o mesmo enquadramento.** Marque com fita no chão onde a peça e o
   celular ficam. Catálogo com fotos padronizadas parece profissional; com
   enquadramentos variados parece bagunça
4. **Cor fiel.** Confira na tela se a cor da foto é a cor real da peça. Cor
   errada é a causa número um de troca — e troca custa frete dobrado

### Especificação técnica

- Formato: **JPG**
- Tamanho: **1000 × 1000 px**, quadrado
- Peso: **abaixo de 200 KB** por imagem

O plano Premium é compartilhado. Foto de 4 MB direto do celular deixa a loja
lenta, e loja lenta perde venda. Comprima tudo em `tinypng.com` antes de subir
— é gratuito e leva segundos.

### Nome do arquivo importa

Não suba `IMG_20260805_142317.jpg`. Renomeie para
`vestido-floral-infantil-rosa-frente.jpg`.

O Google lê nome de arquivo. É SEO grátis, e leva dois segundos por foto.

---

## 4.2 Guia de tamanhos

Crie a página **Guia de tamanhos** e coloque o link **dentro de cada produto**,
logo acima do seletor de tamanho.

Dúvida de tamanho é o principal motivo de abandono de carrinho em moda
infantil. Cada troca evitada é frete que você não paga.

### Tabela base para o Brasil

**Bebê (por idade)**

| Tamanho | Idade | Altura |
|---------|-------|--------|
| RN | 0–1 mês | até 50 cm |
| P | 1–3 meses | 50–62 cm |
| M | 3–6 meses | 62–68 cm |
| G | 6–9 meses | 68–74 cm |
| GG | 9–12 meses | 74–80 cm |

**Infantil (por número)**

| Tamanho | Idade | Altura |
|---------|-------|--------|
| 1 | 1 ano | 80 cm |
| 2 | 2 anos | 92 cm |
| 3 | 3 anos | 98 cm |
| 4 | 4 anos | 104 cm |
| 6 | 6 anos | 116 cm |
| 8 | 8 anos | 128 cm |
| 10 | 10 anos | 140 cm |
| 12 | 12 anos | 152 cm |

**Meça as peças reais da Doce Mate e ajuste.** Fabricante brasileiro varia
muito. Se as peças de um fornecedor puxam para pequeno, escreva isso na
descrição do produto: *"Esta peça veste um número menor — se a criança está
entre dois tamanhos, escolha o maior."* Essa frase evita troca.

### Melhor ainda: medidas da peça

Além da tabela por idade, informe as medidas da peça em si — largura do tórax
e comprimento total. A mãe mede uma roupa que já serve e compara. É o método
mais confiável e quase nenhuma loja pequena faz.

---

## 4.3 Descrição que vende

### Estrutura

**Título:** `Tipo + característica + público`
→ `Vestido Floral Manga Curta Infantil`

Não use `Vestido 001` nem `Ref. 4432`. Ninguém busca isso no Google.

**Descrição curta** (aparece ao lado do preço, 2–3 linhas):
o que é, para qual ocasião, o diferencial.

> Vestido leve de algodão com estampa floral, perfeito para passeio de verão.
> Tecido macio que não irrita a pele e forro no corpo para mais conforto.

**Descrição completa:**

- Composição do tecido (`100% algodão`, `50% algodão / 50% poliéster`)
- Instruções de lavagem
- Como veste (justo, solto, veste maior/menor)
- Medidas da peça por tamanho
- Ocasião de uso
- Se tem forro, bolso, botão, zíper

### Escreva para mãe, avó e madrinha

Quem compra roupa infantil quase nunca é quem vai usar. Menciona o que essa
pessoa avalia: **maciez, se não irrita a pele, se aguenta lavagem, se é
fresco/quentinho, se a criança consegue vestir sozinha**.

"100% algodão" é dado técnico. "Algodão macio que não irrita a pele sensível e
continua macio depois de muitas lavagens" é argumento de venda.

---

## 4.4 Cadastrar em massa

Cadastrar 100 produtos um a um pelo painel leva dias. Use a planilha modelo:

**`produtos/modelo-importacao-woocommerce.csv`**

Preencha no Excel ou Google Sheets, exporte como CSV e importe em
**Produtos → Todos os produtos → Importar**.

Instruções detalhadas de preenchimento em
[`produtos/README.md`](../produtos/README.md).

### Produto variável — o modelo certo para roupa

Uma peça que existe em vários tamanhos e cores **não são vários produtos**. É
**um produto variável** com variações.

```
Produto: Vestido Floral Manga Curta Infantil
├── Tamanho: 2, 4, 6, 8
└── Cor: Rosa, Azul

→ 8 variações, cada uma com seu próprio estoque
```

Isso importa por três motivos: a cliente vê uma página só (e não oito
resultados quase iguais), o estoque é controlado por tamanho, e quando o
tamanho 4 rosa acaba, só ele fica indisponível.

Cadastrar cada tamanho como produto separado é o erro mais comum de loja nova
em moda — e é praticamente impossível de desfazer depois.

---

## 4.5 Por onde começar o catálogo

Não tente subir o estoque inteiro antes de lançar.

**Comece com 20 a 30 peças** — as mais vendidas e as com melhor foto. Uma loja
com 25 produtos bem cadastrados vende mais que uma com 200 pela metade.

Priorize nesta ordem:

1. Campeãs de venda no Instagram (já validadas)
2. Peças com boa margem
3. Peças de tamanho variado em estoque (evita esgotar rápido)
4. Novidades da coleção atual

Cadastre o resto depois do lançamento, no ritmo que der.

---

**Próximo:** [05 — Checklist de lançamento](05-checklist-lancamento.md)
