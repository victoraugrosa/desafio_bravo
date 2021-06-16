#!/bin/bash

diretorio=../public/docs

  if [ ! -d $diretorio ]
    then
        echo "Criando diretorio $diretorio e atualizando anotacoes swagger..."

        mkdir -m 777 ../public/docs
  fi

php ../vendor/bin/openapi --bootstrap ./swagger-constants.php --output ../public/docs ./swagger-v1.php ../app/Http/Controllers

echo "Atualizado anotacoes swagger!"