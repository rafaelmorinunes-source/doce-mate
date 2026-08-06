#!/usr/bin/env bash
#
# Gera plugin/doce-mate-ajustes.zip, pronto para enviar no WordPress.
#
# Uso:  ./plugin/build.sh

set -euo pipefail

RAIZ="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
ORIGEM="$RAIZ/plugin/doce-mate-ajustes"
ZIP="$RAIZ/plugin/doce-mate-ajustes.zip"

echo "Conferindo a sintaxe do PHP..."
if command -v php >/dev/null 2>&1; then
	for arquivo in "$ORIGEM"/*.php; do
		php -l "$arquivo"
	done
else
	echo "  php não encontrado neste computador — pulando a checagem."
fi

echo
echo "Empacotando..."
rm -f "$ZIP"
cd "$RAIZ/plugin"
zip -q -r "$ZIP" doce-mate-ajustes -x "*/.DS_Store"

echo
echo "Pronto: plugin/doce-mate-ajustes.zip"
echo
echo "No WordPress: Plugins → Adicionar novo → Enviar plugin"
