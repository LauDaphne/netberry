# ============================
# VARIABLES
# ============================

ENV_FILE=.env
ENV_EXAMPLE=.env.example

# ============================
# TARGET: install
# ============================

install: create-env up-docker wait-db fix-permissions configure-php-container configure-node-container
	@echo "Instalación completa."

# ============================
# Paso 1: Generar .env
# ============================

create-env:
	@echo "Copiando $(ENV_EXAMPLE) → $(ENV_FILE)..."
	@cp $(ENV_EXAMPLE) $(ENV_FILE)

	@echo "Configurando variables de base de datos:"
	@read -p 'DB_DATABASE: ' DB_DATABASE; \
	read -p 'DB_USERNAME: ' DB_USERNAME; \
	read -p 'DB_PASSWORD: ' DB_PASSWORD; \
	read -p 'DB_ROOT_PASSWORD: ' DB_ROOT_PASSWORD; \
	sed -i "s/^DB_DATABASE=.*/DB_DATABASE=$$DB_DATABASE/" $(ENV_FILE); \
	sed -i "s/^DB_USERNAME=.*/DB_USERNAME=$$DB_USERNAME/" $(ENV_FILE); \
	sed -i "s/^DB_PASSWORD=.*/DB_PASSWORD=$$DB_PASSWORD/" $(ENV_FILE); \
	sed -i "s/^DB_ROOT_PASSWORD=.*/DB_ROOT_PASSWORD=$$DB_ROOT_PASSWORD/" $(ENV_FILE)

	@echo "Archivo .env generado."

# ============================
# Paso 2: Levantar Docker
# ============================

up-docker:
	@echo "Levantando contenedores..."
	@docker compose up -d
	@echo "Contenedores iniciados."

# ============================
# Paso 3: Esperar a MySQL
# ============================

wait-db:
	@echo "Esperando a que MySQL esté disponible..."
	@until docker compose exec mysql mysqladmin ping -h localhost --silent; do \
		sleep 2; \
	done
	@echo "MySQL listo."

# ============================
# Paso 4: Permisos Laravel
# ============================

fix-permissions:
	@echo "Corrigiendo permisos..."
	@docker compose exec php chown -R www-data:www-data storage bootstrap/cache
	@docker compose exec php chmod -R 775 storage bootstrap/cache
	@docker compose exec php git config --global --add safe.directory /var/www/html


# ============================
# Paso 5: Composer + Artisan
# ============================

configure-php-container:
	@echo "Instalando dependencias PHP..."
	@docker compose exec php composer install

	@echo "Generando APP_KEY..."
	@docker compose exec php php artisan key:generate

	@echo "Ejecutando migraciones..."
	@docker compose exec php php artisan migrate --force

	@echo "Ejecutando seeders..."
	@docker compose exec php php artisan db:seed --force

# ============================
# Paso 6: Node
# ============================

configure-node-container:
	@echo "Instalando dependencias Node..."
	@docker compose exec node npm install

	@echo "Compilando assets..."
	@docker compose exec node npm run build

.PHONY: install create-env up-docker wait-db fix-permissions configure-php-container configure-node-container
