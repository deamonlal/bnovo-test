#!/bin/bash

if [ -f ".env.example" ]; then
    cp .env.example .env
    echo ".env файл успешно создан из .env.example"
else
    echo "Файл .env.example не найден!"
fi
