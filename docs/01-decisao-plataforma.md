# 1. Decisão de plataforma

## Recomendação: WordPress + WooCommerce na Hostinger que você já paga

### Por quê

**Você já pagou a hospedagem.** O plano Premium da Hostinger inclui domínio
grátis no primeiro ano, SSL ilimitado, CDN e até 100 sites. Rodar a loja ali
custa R$ 0 a mais por mês. Nuvemshop e Shopify cobrariam R$ 100–250/mês
*além* do que você já gasta.

**Sua mãe consegue mexer sozinha.** O painel do WooCommerce é o mesmo tipo de
tela de qualquer sistema de loja: cadastrar produto, ver pedido, imprimir
etiqueta. Não precisa de programador para o dia a dia — e é justamente o dia a
dia que quebra a maioria das lojas virtuais de pequeno negócio.

**Sem mensalidade, sem comissão sobre venda.** As plataformas prontas cobram
mensalidade *e* percentual. O WooCommerce é gratuito; você paga só a taxa da
maquininha virtual (Mercado Pago), que existiria de qualquer forma.

**Você é dono do site.** Se um dia quiser trocar de hospedagem, leva tudo
junto. Em plataforma fechada, sair significa recomeçar.

### O ponto técnico que decidiu

O plano **Premium da Hostinger não suporta Node.js** — isso só existe a partir
dos planos Business, Cloud e VPS. Ou seja: um site feito em Next.js/React não
roda na hospedagem que você já tem. Rodaria de graça na Vercel, mas aí sua mãe
dependeria de alguém programando para cada mudança de preço ou produto novo.

O Premium roda **PHP + MySQL**, que é exatamente o que WordPress e WooCommerce
precisam. A hospedagem que você já pagou é feita para esse caminho.

### Limitação honesta do plano Premium

O Premium tem **backup semanal**, não diário, e menos PHP workers que o plano
Business. Para uma loja começando — alguns pedidos por dia — isso é
tranquilo. Quando o volume crescer (mais de ~20 pedidos/dia ou lentidão no
carrinho), vale migrar para o Business. A migração é feita pelo suporte da
Hostinger, sem refazer nada.

Não gaste com o upgrade agora. Comece no que você já tem.

---

## As opções que foram descartadas — e quando reconsiderar

### Nuvemshop / Shopify

**Descartado porque:** custo fixo de R$ 100–250/mês para uma loja que ainda
não validou venda online, somando a uma hospedagem já paga e ociosa.

**Reconsidere se:** a operação passar de ~150 pedidos/mês e a parte técnica
começar a tomar tempo demais. Aí a mensalidade se paga em suporte e
integrações prontas.

### Site próprio em código (Next.js)

**Descartado porque:** não roda na hospedagem atual, e cria dependência
permanente de programador. Cada produto novo viraria uma tarefa técnica.

**Reconsidere se:** a loja crescer a ponto de precisar de algo que o
WooCommerce não faz — e aí provavelmente já haverá orçamento para uma equipe.

### Só catálogo com botão de WhatsApp

**Descartado porque:** a Doce Mate já vende por Instagram e WhatsApp. Um
catálogo sem checkout não resolve nada novo — o gargalo hoje é justamente ter
que responder cada pessoa manualmente para fechar venda.

**Vale como complemento:** manter o botão de WhatsApp no site para dúvidas
sobre tamanho é excelente em moda infantil. Mas o carrinho precisa funcionar
sozinho.

---

## O que a Doce Mate tem de vantagem

Coisas que a maioria das lojas virtuais novas não tem e você já tem:

- **CNPJ ativo** — permite emitir nota fiscal, integrar Mercado Pago como
  pessoa jurídica (taxas melhores) e contratar frete com desconto.
- **Loja física em Porto Alegre** — habilita "retirar na loja", que é frete
  grátis para você e para o cliente. Em moda infantil, onde a dúvida de
  tamanho trava a compra, a opção de retirar e trocar na hora converte muito.
- **Instagram com público** — você não precisa comprar tráfego para as
  primeiras vendas. Já tem para quem anunciar no dia do lançamento.
- **Estoque real e fotos** — o conteúdo mais caro de produzir já existe.

O plano inteiro se apoia nesses quatro pontos.

---

**Próximo:** [02 — Setup na Hostinger](02-setup-hostinger-woocommerce.md)
