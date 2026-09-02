pipeline {
    agent any
    
    environment {
        PATH = "/home/martinjovanovski/.config/herd-lite/bin:/usr/local/bin:/usr/bin:/bin:${env.PATH}"
        DB_CONNECTION = 'sqlite'
        DB_DATABASE = ':memory:'
        APP_ENV = 'testing'
    }
    
    stages {
        
        stage('Checkout') {
            steps {
                checkout scm
            }
        }
        
        stage('Install PHP Dependencies') {
            steps {
                sh 'composer install --no-progress --prefer-dist --optimize-autoloader'
            }
        }
        
        stage('Install & Build Assets') {
            steps {
                sh 'npm ci'
                sh 'npm run build'
            }
        }
        
        stage('Prepare Environment') {
            steps {
                sh '''
                    if [ ! -f .env.testing ]; then
                        cp .env.example .env.testing
                    fi
                    php artisan key:generate --env=testing
                '''
            }
        }
        
        stage('Run Tests') {
            steps {
                sh 'php artisan test'
            }
        }
    }
        
    post {
        always {
            cleanWs()
        }
        success {
            echo 'Pipeline executed successfully!'
        }
        failure {
            echo 'Pipeline execution failed.'
        }
    }
}
