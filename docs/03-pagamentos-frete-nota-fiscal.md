# 3. Pagamentos, frete e nota fiscal

Esta é a parte que faz a loja sair do papel: receber dinheiro, entregar a peça
e emitir documento. Nenhuma das três pode ficar para depois.

---

## 3.0 Antes de tudo: checkout clássico, não em blocos

O WooCommerce hoje tem **dois checkouts diferentes**, e instalações novas vêm
com o **checkout em blocos** ligado por padrão. Para loja brasileira, isso
precisa ser trocado antes de configurar qualquer outra coisa.

### O problema

O plugin **Brazilian Market on WooCommerce** — que adiciona CPF, CNPJ, bairro
e máscara de CEP — **não funciona no checkout em blocos**. Sem ele, o checkout
do WooCommerce é americano: não tem campo de CPF e não tem bairro.

Isso não é questão de estética. Sem CPF você **não consegue emitir nota
fiscal**, e sem bairro o endereço sai incompleto para a transportadora. São
dois bloqueios legais e operacionais, não inconveniências.

### O trade-off, honestamente

O checkout em blocos é mais moderno e há relatos de conversão melhor. A
contrapartida é que boa parte do ecossistema brasileiro — campos fiscais,
integrações de frete, emissores de NF-e — ainda assume o checkout clássico.

Para uma loja fazendo as primeiras vendas, **quebrar a emissão de nota para
perseguir conversão é troca ruim**. Comece no clássico. Dá para migrar depois,
quando os plugins brasileiros tiverem acompanhado.

> O Mercado Pago funciona nos dois. Quem força a decisão é o plugin de campos
> brasileiros, não o de pagamento.

### Como trocar

1. **Páginas → Finalizar compra**, abrir para edição
2. Selecionar o bloco *Finalizar compra* e, na barra de ferramentas do bloco,
   usar a opção de **voltar ao checkout clássico**
3. Se a opção não aparecer, apague o bloco e coloque no lugar um bloco de
   *código curto* com: `[woocommerce_checkout]`
4. Repetir na página **Carrinho**, com `[woocommerce_cart]`
5. Atualizar as duas páginas

Faça essa troca **antes** de instalar o Brazilian Market e antes de configurar
frete e pagamento. Trocar depois obriga a refazer testes.

### Como conferir que deu certo

Depois de instalar o Brazilian Market, abra o checkout com um produto no
carrinho. Devem aparecer:

- Seletor **Pessoa Física / Pessoa Jurídica**
- Campo **CPF** (ou CNPJ)
- Campo **Bairro**
- CEP com máscara e preenchimento automático do endereço

Se algum desses faltar, você ainda está no checkout em blocos.

---

## 3.1 Pagamentos — Mercado Pago

### Por que Mercado Pago

- Aceita **PIX, cartão de crédito, débito e boleto** em uma integração só
- Plugin oficial para WooCommerce, mantido e em português
- **Sem mensalidade** — só percentual por venda
- Marca conhecida: reduz o medo de comprar em loja nova

Alternativas boas: **PagBank** (taxas parecidas) e **InfinitePay** (taxa menor
no PIX). Se sua mãe já usa maquininha de algum deles, vale unificar para
simplificar a conciliação.

### Taxas (referência)

| Meio | Taxa aproximada | Prazo de recebimento |
|------|-----------------|---------------------|
| PIX | ~0,99% | Na hora |
| Cartão de crédito | ~4,98% | 14 dias |
| Cartão parcelado | maior conforme parcelas | 14 dias |
| Boleto | ~3,49% | 1 a 3 dias após pagamento |

Confirme os valores atuais no painel do Mercado Pago — mudam com frequência e
melhoram conforme o volume.

### Configuração

1. Criar conta no Mercado Pago **com o CNPJ da Doce Mate** (não com CPF —
   taxas de PJ são melhores e a nota fiscal precisa bater com o recebedor)
2. Instalar o plugin **Mercado Pago para WooCommerce**
3. No painel do Mercado Pago, ir em *Seu negócio → Configurações →
   Credenciais* e copiar **Public Key** e **Access Token**
4. Colar nas configurações do plugin no WordPress
5. Ativar PIX, cartão e boleto
6. Testar com as **credenciais de teste** antes de ir ao ar

### Incentive o PIX

Configure **5% de desconto no PIX** (o plugin tem essa opção nativa). Você
economiza ~4% de taxa de cartão, recebe na hora e o cliente sente que ganhou
vantagem. É o único desconto que se paga sozinho.

### Parcelamento

Ofereça em até **3x sem juros** para compras acima de R$ 150. Em vestuário
infantil o ticket médio é baixo; parcelamento longo não aumenta conversão e só
atrasa seu recebimento.

---

## 3.2 Frete — Melhor Envio + retirada na loja

### Melhor Envio

Intermediador que dá acesso a Correios (PAC/SEDEX), Jadlog, Loggi e outras com
**preço de grande volume** — costuma sair 40% a 60% mais barato que balcão dos
Correios. Gratuito, você paga só o frete de cada envio.

Configuração:

1. Criar conta em `melhorenvio.com.br` com o CNPJ
2. Instalar o plugin **Melhor Envio** no WordPress
3. Conectar via token gerado no painel
4. Definir o **CEP de origem** — o endereço da loja física em Porto Alegre
5. Ativar as transportadoras que quiser oferecer

### Dimensões e peso — não pule isso

O frete é calculado por peso *e* volume. Se você cadastrar produto sem essas
informações, o cálculo sai errado e você paga a diferença do próprio bolso.

Valores de referência para vestuário infantil (embalado):

| Tipo de peça | Peso | Dimensões (C×L×A cm) |
|--------------|------|---------------------|
| Body / camiseta | 150 g | 20 × 15 × 3 |
| Vestido | 250 g | 25 × 20 × 4 |
| Conjunto | 350 g | 30 × 22 × 5 |
| Casaco / moletom | 500 g | 32 × 25 × 8 |
| Saída de maternidade | 600 g | 35 × 28 × 10 |

Pese algumas peças reais numa balança de cozinha e ajuste. Cinco minutos aqui
evitam prejuízo em todo pedido.

> **Cuidado:** os Correios cobram por **peso cubado** quando o volume é grande
> em relação ao peso. Roupa infantil é leve e fofa — comprima bem a embalagem.
> Embalagem menor é frete menor.

### Retirada na loja — sua maior vantagem

Ative **retirada grátis na loja física**. Em WooCommerce: *Configurações →
Entrega → Adicionar zona de entrega*.

Monte assim:

| Zona | Região | Método |
|------|--------|--------|
| Porto Alegre | CEPs de POA | Retirada na loja (R$ 0) + PAC + SEDEX |
| Rio Grande do Sul | Estado RS | PAC + SEDEX |
| Brasil | Restante | PAC + SEDEX |

Por que isso importa tanto em moda infantil: a dúvida de tamanho é o principal
motivo de abandono de carrinho. "Compro online e troco na loja se não servir"
elimina o risco da compra — e traz a cliente até a loja física, onde ela
costuma levar mais uma peça.

### Frete grátis

Configure frete grátis acima de um valor — comece em **R$ 249** para o Rio
Grande do Sul. Aumenta o ticket médio ("falta pouco para o frete grátis") sem
comer margem em pedido pequeno. Revise depois de dois meses com dados reais.

---

## 3.3 Nota fiscal

A Doce Mate tem CNPJ, então **emitir NF-e em venda online é obrigatório**.
Não há a informalidade que o Instagram permite: o pedido tem rastreio,
pagamento registrado e destinatário identificado.

### Como resolver

**Opção A — Bling ou Tiny ERP (recomendado)**

ERPs brasileiros que integram com WooCommerce e emitem NF-e automaticamente a
cada pedido. Custam a partir de ~R$ 60/mês.

Vale a pena quando passar de ~1 pedido por dia: a emissão manual vira o
gargalo da operação, e o ERP ainda unifica o estoque da loja física com o da
loja virtual — que é o problema seguinte que você vai ter.

**Opção B — Emissor gratuito da SEFAZ-RS (para começar)**

Emitir manualmente pelo emissor da Secretaria da Fazenda do RS. Grátis, porém
trabalhoso. Funciona nos primeiros meses, com poucos pedidos por dia.

### Fale com o contador antes de ligar a loja

Duas perguntas específicas, que mudam a configuração da loja:

1. **Qual CFOP usar em venda interestadual para consumidor final?**
   (normalmente 6108, mas confirme — muda o cálculo de imposto)
2. **O regime tributário atual cobre venda online?**
   (Simples Nacional geralmente cobre, mas a atividade de comércio eletrônico
   pode precisar constar no CNAE)

Resolver isso antes custa uma conversa. Resolver depois custa multa.

---

## 3.4 Checklist desta etapa

- [ ] Conta Mercado Pago criada com CNPJ
- [ ] Plugin conectado e testado com credenciais de teste
- [ ] PIX com 5% de desconto ativo
- [ ] Parcelamento em até 3x configurado
- [ ] Conta Melhor Envio criada e conectada
- [ ] CEP de origem = loja física
- [ ] Zonas de entrega criadas (POA / RS / Brasil)
- [ ] Retirada na loja ativa e gratuita
- [ ] Frete grátis acima de R$ 249 no RS
- [ ] Peso e dimensões definidos para cada tipo de peça
- [ ] Contador consultado sobre CFOP e regime
- [ ] Caminho de emissão de NF-e definido

---

**Próximo:** [04 — Fotos e cadastro de produtos](04-fotos-e-cadastro-produtos.md)
