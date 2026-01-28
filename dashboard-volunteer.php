<?php
require_once 'auth_check.php';
checkAuth('volunteer');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Bénévole - Natfwa9</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary-color: #3b82f6;
            --primary-gradient: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            --secondary-color: #10b981;
            --accent-color: #ef4444;
            --warm-color: #f59e0b;
            
            --text-dark: #111827;
            --text-light: #6b7280;
            --white: #ffffff;
            --bg-light: #f3f4f6;
            
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --purple: #8b5cf6;
            
            --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --border-radius: 16px;
        }

        body {
            font-family: "Inter", sans-serif;
            background: var(--bg-light);
            color: var(--text-dark);
        }

        .dashboard {
            display: grid;
            grid-template-columns: 260px 1fr;
            min-height: 100vh;
        }

        .sidebar {
            background: var(--white);
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.05);
            padding: 2rem 0;
        }

        .logo {
            padding: 0 1.5rem 2rem;
            border-bottom: 1px solid #e5e7eb;
        }

        .logo h2 {
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-size: 1.5rem;
        }

        .logo p {
            font-size: 0.8rem;
            color: var(--text-light);
            margin-top: 0.25rem;
        }

        .nav-menu {
            padding: 1.5rem 0;
        }

        .nav-item {
            padding: 0.75rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: var(--text-light);
            cursor: pointer;
            transition: all 0.3s;
        }

        .nav-item:hover, .nav-item.active {
            background: linear-gradient(90deg, rgba(59, 130, 246, 0.1) 0%, transparent 100%);
            color: var(--primary-color);
            border-left: 3px solid var(--primary-color);
        }

        .nav-item svg {
            width: 20px;
            height: 20px;
        }

        .main-content {
            padding: 2rem;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .welcome h1 {
            font-size: 1.75rem;
            margin-bottom: 0.25rem;
        }

        .welcome p {
            color: var(--text-light);
        }

        .user-actions {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            background: var(--white);
            padding: 0.5rem 1rem;
            border-radius: 25px;
            box-shadow: var(--shadow);
            cursor: pointer;
        }

        .avatar {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background: var(--primary-gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }

        .impact-banner {
            background: linear-gradient(135deg, rgba(0, 195, 255, 0.1) 0%, rgba(0, 253, 225, 0.1) 100%);
            border: 2px solid var(--primary-color);
            border-radius: var(--border-radius);
            padding: 2rem;
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .impact-content h2 {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }

        .impact-content p {
            color: var(--text-light);
        }

        .impact-emoji {
            font-size: 4rem;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: var(--white);
            padding: 1.5rem;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .stat-info h3 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.25rem;
        }

        .stat-info p {
            color: var(--text-light);
            font-size: 0.9rem;
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        .stat-icon.blue { background: rgba(0, 195, 255, 0.1); color: var(--primary-color); }
        .stat-icon.green { background: rgba(16, 185, 129, 0.1); color: var(--success); }
        .stat-icon.orange { background: rgba(245, 158, 11, 0.1); color: var(--warning); }
        .stat-icon.purple { background: rgba(168, 85, 247, 0.1); color: var(--purple); }

        .content-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
        }

        .card {
            background: var(--white);
            padding: 1.5rem;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
        }

        .card.full-width {
            grid-column: 1 / -1;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: 600;
        }

        .view-all {
            color: var(--primary-color);
            text-decoration: none;
            font-size: 0.9rem;
        }

        .opportunity-item {
            padding: 1rem;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            margin-bottom: 1rem;
            transition: all 0.3s;
        }

        .opportunity-item:hover {
            border-color: var(--primary-color);
            box-shadow: 0 4px 12px rgba(0, 195, 255, 0.15);
        }

        .opportunity-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 0.75rem;
        }

        .opportunity-header h4 {
            margin-bottom: 0.25rem;
        }

        .badge {
            padding: 0.25rem 0.75rem;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .badge.urgent {
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger);
        }

        .badge.flexible {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
        }

        .opportunity-meta {
            color: var(--text-light);
            font-size: 0.85rem;
            margin-bottom: 0.75rem;
        }

        .btn {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s;
            font-size: 0.9rem;
        }

        .btn-primary {
            background: var(--primary-gradient);
            color: white;
        }

        .btn-outline {
            background: white;
            color: var(--primary-color);
            border: 1px solid var(--primary-color);
        }

        .btn:hover {
            transform: translateY(-2px);
        }

        .mission-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            background: rgba(0, 195, 255, 0.05);
            border-radius: 8px;
            margin-bottom: 1rem;
        }

        .mission-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: var(--primary-gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            flex-shrink: 0;
        }

        .mission-info {
            flex: 1;
        }

        .mission-info h4 {
            margin-bottom: 0.25rem;
        }

        .mission-info p {
            color: var(--text-light);
            font-size: 0.85rem;
        }

        .progress-ring {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: conic-gradient(var(--primary-color) 0deg 216deg, #e5e7eb 216deg 360deg);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .progress-ring::before {
            content: '';
            position: absolute;
            width: 60px;
            height: 60px;
            background: white;
            border-radius: 50%;
        }

        .progress-value {
            position: relative;
            z-index: 1;
            font-weight: 700;
            font-size: 1.2rem;
        }

        .leaderboard-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 0.75rem;
            background: rgba(0, 195, 255, 0.05);
        }

        .leaderboard-rank {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background: var(--primary-gradient);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
        }

        .leaderboard-info {
            flex: 1;
        }

        .leaderboard-info h4 {
            font-size: 0.95rem;
        }

        .leaderboard-info p {
            font-size: 0.8rem;
            color: var(--text-light);
        }

        .leaderboard-points {
            font-weight: 700;
            color: var(--primary-color);
        }

        @media (max-width: 1024px) {
            .content-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .dashboard {
                grid-template-columns: 1fr;
            }

            .sidebar {
                display: none;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .impact-banner {
                flex-direction: column;
                text-align: center;
                gap: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard">
        <aside class="sidebar">
            <div class="logo">
                <img src="logo.png" alt="Natfwa9" style="height: 40px;">
                <p>Espace Bénévole</p>
            </div>
            <nav class="nav-menu">
                <div class="nav-item active">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    <span>Tableau de bord</span>
                </div>
                <div class="nav-item">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    <span>Opportunités</span>
                </div>
                <div class="nav-item">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                    </svg>
                    <span>Mes Missions</span>
                </div>
                <div class="nav-item">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <span>Planning</span>
                </div>
                <div class="nav-item">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                    <span>Communauté</span>
                </div>
                <div class="nav-item">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                    <span>Mon Impact</span>
                </div>
                <div class="nav-item">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"/>
                    </svg>
                    <span>Récompenses</span>
                </div>
                <div class="nav-item">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span>Paramètres</span>
                </div>
                <a href="logout.php" class="nav-item" style="text-decoration: none; margin-top: auto; border-top: 1px solid #f0f0f0;">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #ef4444;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    <span style="color: #ef4444;">Déconnexion</span>
                </a>
            </nav>
        </aside>

        <main class="main-content">
            <header class="header">
                <div class="welcome">
                    <h1>Bienvenue, <?php echo htmlspecialchars($_SESSION['fullname']); ?>! 💙</h1>
                    <p>Merci pour votre engagement envers nos élèves</p>
                </div>
                <div class="user-actions">
                    <div class="user-profile">
                        <div class="avatar">FZ</div>
                        <span><?php echo htmlspecialchars($_SESSION['fullname']); ?></span>
                    </div>
                </div>
            </header>

            <div class="impact-banner">
                <div class="impact-content">
                    <h2>🎉 Votre impact grandit chaque jour!</h2>
                    <p>Vous avez aidé 12 élèves orphelins ce mois-ci</p>
                </div>
                <div class="impact-emoji">❤️</div>
            </div>

            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-info">
                        <h3>28h</h3>
                        <p>Heures bénévoles</p>
                    </div>
                    <div class="stat-icon blue">⏱</div>
                </div>
                <div class="stat-card">
                    <div class="stat-info">
                        <h3>12</h3>
                        <p>Élèves accompagnés</p>
                    </div>
                    <div class="stat-icon green">👥</div>
                </div>
                <div class="stat-card">
                    <div class="stat-info">
                        <h3>8</h3>
                        <p>Missions complétées</p>
                    </div>
                    <div class="stat-icon orange">✓</div>
                </div>
                <div class="stat-card">
                    <div class="stat-info">
                        <h3>450</h3>
                        <p>Points d'impact</p>
                    </div>
                    <div class="stat-icon purple">⭐</div>
                </div>
            </div>

            <div class="content-grid">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Opportunités Disponibles</h2>
                        <a href="#" class="view-all">Voir toutes →</a>
                    </div>
                    
                    <div class="opportunity-item">
                        <div class="opportunity-header">
                            <div>
                                <h4>Aide aux devoirs - Mathématiques</h4>
                                <div class="opportunity-meta">📚 Soutien scolaire • 2h/semaine</div>
                            </div>
                            <span class="badge urgent">Urgent</span>
                        </div>
                        <p style="color: var(--text-light); font-size: 0.9rem; margin-bottom: 0.75rem;">
                            Recherche bénévole pour accompagner 3 élèves orphelins en mathématiques niveau Bac.
                        </p>
                        <button class="btn btn-primary">Postuler</button>
                    </div>

                    <div class="opportunity-item">
                        <div class="opportunity-header">
                            <div>
                                <h4>Atelier d'orientation professionnelle</h4>
                                <div class="opportunity-meta">🎯 Orientation • Ponctuel</div>
                            </div>
                            <span class="badge flexible">Flexible</span>
                        </div>
                        <p style="color: var(--text-light); font-size: 0.9rem; margin-bottom: 0.75rem;">
                            Animer un atelier sur les métiers de l'ingénierie pour 15 élèves.
                        </p>
                        <button class="btn btn-primary">Postuler</button>
                    </div>

                    <div class="opportunity-item">
                        <div class="opportunity-header">
                            <div>
                                <h4>Mentorat individuel</h4>
                                <div class="opportunity-meta">🤝 Mentorat • 1h/semaine</div>
                            </div>
                            <span class="badge flexible">Flexible</span>
                        </div>
                        <p style="color: var(--text-light); font-size: 0.9rem; margin-bottom: 0.75rem;">
                            Accompagner un élève orphelin dans son parcours scolaire et personnel.
                        </p>
                        <button class="btn btn-primary">Postuler</button>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Mes Missions Actives</h2>
                    </div>

                    <div class="mission-item">
                        <div class="mission-icon">📖</div>
                        <div class="mission-info">
                            <h4>Aide aux devoirs</h4>
                            <p>3 élèves • Tous les mercredis</p>
                        </div>
                        <div class="progress-ring">
                            <span class="progress-value">60%</span>
                        </div>
                    </div>

                    <div class="mission-item">
                        <div class="mission-icon">💬</div>
                        <div class="mission-info">
                            <h4>Mentorat - Ahmed</h4>
                            <p>1 élève • Tous les lundis</p>
                        </div>
                        <div class="progress-ring">
                            <span class="progress-value">75%</span>
                        </div>
                    </div>

                    <div class="mission-item">
                        <div class="mission-icon">🎓</div>
                        <div class="mission-info">
                            <h4>Atelier orientation</h4>
                            <p>12 élèves • Samedi prochain</p>
                        </div>
                        <div class="progress-ring">
                            <span class="progress-value">40%</span>
                        </div>
                    </div>
                </div>

                <div class="card full-width">
                    <div class="card-header">
                        <h2 class="card-title">🏆 Tableau d'honneur des bénévoles</h2>
                        <a href="#" class="view-all">Voir classement complet →</a>
                    </div>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1rem;">
                        <div>
                            <h3 style="font-size: 1rem; margin-bottom: 1rem; color: var(--text-light);">Top ce mois</h3>
                            <div class="leaderboard-item">
                                <div class="leaderboard-rank">1</div>
                                <div class="leaderboard-info">
                                    <h4>Omar Idrissi</h4>
                                    <p>42h bénévoles</p>
                                </div>
                                <div class="leaderboard-points">850 pts</div>
                            </div>
                            <div class="leaderboard-item" style="background: rgba(16, 185, 129, 0.05);">
                                <div class="leaderboard-rank" style="background: var(--success);">2</div>
                                <div class="leaderboard-info">
                                    <h4>Vous</h4>
                                    <p>28h bénévoles</p>
                                </div>
                                <div class="leaderboard-points">450 pts</div>
                            </div>
                            <div class="leaderboard-item">
                                <div class="leaderboard-rank" style="background: var(--warning);">3</div>
                                <div class="leaderboard-info">
                                    <h4>Karim Alami</h4>
                                    <p>24h bénévoles</p>
                                </div>
                                <div class="leaderboard-points">380 pts</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>