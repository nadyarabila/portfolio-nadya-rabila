<?php

declare(strict_types=1);

function getSiteSettings(): array
{
    $pdo = getDBConnection();
    $stmt = $pdo->query('SELECT * FROM site_settings LIMIT 1');
    $settings = $stmt->fetch();

    if (!$settings) {
        return [
            'full_name'     => 'Nadya Rabila',
            'greeting'      => '👋 Halo, saya',
            'tagline'       => 'Mahasiswa Informatika Universitas Samudra...',
            'profile_image' => 'img/profil.png',
            'footer_name'   => 'Nadya Rabila',
            'footer_text'   => '&copy; 2026'
        ];
    }

    return $settings;
}

function updateSiteSettings(array $data): bool
{
    $pdo = getDBConnection();
    
    // Check if any record exists
    $stmt = $pdo->query('SELECT id FROM site_settings LIMIT 1');
    $existing = $stmt->fetch();

    if ($existing) {
        $stmt = $pdo->prepare(
            'UPDATE site_settings SET 
                full_name = :full_name,
                greeting = :greeting,
                tagline = :tagline,
                profile_image = :profile_image,
                footer_name = :footer_name,
                footer_text = :footer_text
             WHERE id = :id'
        );
        return $stmt->execute([
            ':full_name'     => $data['full_name'],
            ':greeting'      => $data['greeting'],
            ':tagline'       => $data['tagline'],
            ':profile_image' => $data['profile_image'],
            ':footer_name'   => $data['footer_name'],
            ':footer_text'   => $data['footer_text'],
            ':id'            => $existing['id']
        ]);
    } else {
        $stmt = $pdo->prepare(
            'INSERT INTO site_settings (full_name, greeting, tagline, profile_image, footer_name, footer_text) 
             VALUES (:full_name, :greeting, :tagline, :profile_image, :footer_name, :footer_text)'
        );
        return $stmt->execute([
            ':full_name'     => $data['full_name'],
            ':greeting'      => $data['greeting'],
            ':tagline'       => $data['tagline'],
            ':profile_image' => $data['profile_image'],
            ':footer_name'   => $data['footer_name'],
            ':footer_text'   => $data['footer_text']
        ]);
    }
}
