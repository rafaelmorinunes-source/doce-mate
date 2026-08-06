#!/usr/bin/env bash
#
# Gera o arquivo docemate.zip pronto para enviar no WordPress.
#
# Uso:  ./tema/build.sh
#
# Antes de rodar, preencha juridico/dados-da-loja.conf — o rodapé do tema usa
# os mesmos dados das páginas jurídicas.

set -euo pipefail

RAIZ="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
TEMA="$RAIZ/tema/docemate"
ZIP="$RAIZ/tema/docemate.zip"

echo "Gerando os dados da loja a partir de juridico/dados-da-loja.conf..."
if ! python3 "$RAIZ/juridico/preencher.py"; then
	echo
	echo "Preencha os campos que faltam e rode de novo." >&2
	exit 1
fi

if [ ! -f "$TEMA/dados-loja.php" ]; then
	echo "dados-loja.php não foi gerado. Abortando." >&2
	exit 1
fi

echo
echo "Conferindo a sintaxe do PHP..."
if command -v php >/dev/null 2>&1; then
	for arquivo in "$TEMA"/*.php; do
		php -l "$arquivo"
	done
else
	echo "  php não encontrado neste computador — pulando a checagem."
	echo "  (o WordPress vai avisar se houver erro no envio)"
fi

echo
echo "Empacotando..."
rm -f "$ZIP"
cd "$RAIZ/tema"
zip -q -r "$ZIP" docemate \
	-x "docemate/.*" \
	-x "*/.DS_Store"

echo
echo "Pronto: tema/docemate.zip"
echo
echo "No WordPress: Aparência → Temas → Adicionar novo → Enviar tema"
echo "Envie o zip, ative, e o rodapé com CNPJ aparece sozinho."
