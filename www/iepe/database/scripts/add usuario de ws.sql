ALTER TABLE admins CHANGE rol rol ENUM('superadmin',
                'jefe_bienestar',
                'secretario',
                'decano',
                'director_arquitectura',
                'director_disenio_grafico',
                'consultor_ws');