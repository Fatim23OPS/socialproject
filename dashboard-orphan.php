<?php
require_once 'auth_check.php';
checkAuth('orphan');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Espace - Natfwa9</title>
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

        .special-access {
            margin: 1.5rem;
            padding: 1rem;
            background: linear-gradient(135deg, rgba(168, 85, 247, 0.1) 0%, rgba(0, 195, 255, 0.1) 100%);
            border: 2px solid var(--purple);
            border-radius: 8px;
            text-align: center;
        }

        .special-access h4 {
            color: var(--purple);
            font-size: 0.9rem;
            margin-bottom: 0.25rem;
        }

        .special-access p {
            font-size: 0.75rem;
            color: var(--text-light);
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

        .notification-btn {
            position: relative;
            background: var(--white);
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            cursor: pointer;
            box-shadow: var(--shadow);
        }

        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: var(--danger);
            color: white;
            font-size: 0.7rem;
            padding: 2px 6px;
            border-radius: 10px;
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

        .support-banner {
            background: linear-gradient(135deg, rgba(168, 85, 247, 0.1) 0%, rgba(0, 195, 255, 0.1) 100%);
            border: 2px solid var(--purple);
            border-radius: var(--border-radius);
            padding: 1.5rem;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .support-banner-icon {
            font-size: 2.5rem;
        }

        .support-banner-content {
            flex: 1;
        }

        .support-banner-content h3 {
            margin-bottom: 0.25rem;
            color: var(--purple);
        }

        .support-banner-content p {
            color: var(--text-light);
            font-size: 0.9rem;
        }

        .btn-support {
            padding: 0.75rem 1.5rem;
            background: var(--purple);
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 500;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
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
        .stat-icon.purple { background: rgba(168, 85, 247, 0.1); color: var(--purple); }

        .content-grid {
            display: grid;
            grid-template-columns: 1.5fr 1fr;
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

        .course-item {
            display: flex;
            gap: 1rem;
            padding: 1rem;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            margin-bottom: 1rem;
            transition: all 0.3s;
        }

        .course-item:hover {
            border-color: var(--primary-color);
            box-shadow: 0 4px 12px rgba(0, 195, 255, 0.15);
        }

        .course-thumbnail {
            width: 80px;
            height: 80px;
            border-radius: 8px;
            background: var(--primary-gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            flex-shrink: 0;
        }

        .course-info {
            flex: 1;
        }

        .course-info h4 {
            margin-bottom: 0.25rem;
        }

        .course-meta {
            display: flex;
            gap: 1rem;
            color: var(--text-light);
            font-size: 0.85rem;
            margin-top: 0.5rem;
        }

        .progress-bar {
            height: 6px;
            background: #e5e7eb;
            border-radius: 3px;
            overflow: hidden;
            margin-top: 0.5rem;
        }

        .progress-fill {
            height: 100%;
            background: var(--primary-gradient);
            transition: width 0.3s;
        }

        .badge-free {
            padding: 0.25rem 0.75rem;
            background: rgba(168, 85, 247, 0.1);
            color: var(--purple);
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .mentor-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            margin-bottom: 1rem;
        }

        .mentor-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: var(--primary-gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            flex-shrink: 0;
        }

        .mentor-info {
            flex: 1;
        }

        .mentor-info h4 {
            margin-bottom: 0.25rem;
        }

        .mentor-info p {
            color: var(--text-light);
            font-size: 0.85rem;
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

        .btn:hover {
            transform: translateY(-2px);
        }

        .resource-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            background: rgba(0, 195, 255, 0.05);
            border-radius: 8px;
            margin-bottom: 1rem;
        }

        .resource-icon {
            width: 45px;
            height: 45px;
            border-radius: 8px;
            background: var(--primary-gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
        }

        .resource-info {
            flex: 1;
        }

        .resource-info h4 {
            font-size: 0.95rem;
            margin-bottom: 0.25rem;
        }

        .resource-info p {
            font-size: 0.8rem;
            color: var(--text-light);
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

            .support-banner {
                flex-direction: column;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard">
        <aside class="sidebar">
            <div class="logo">
                <img src="logo.png" alt="Natfwa9" style="height: 40px;">
            </div>
            
            <div class="special-access">
                <h4>✨ Accès Gratuit Complet</h4>
                <p>Toutes les ressources à 100% gratuites</p>
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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                    <span>Mes Cours</span>
                </div>
                <div class="nav-item">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <span>Ressources Gratuites</span>
                </div>
                <div class="nav-item">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                    <span>Mon Mentor</span>
                </div>
                <div class="nav-item">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <span>Planning</span>
                </div>
                <div class="nav-item">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                    </svg>
                    <span>Mes Progrès</span>
                </div>
                <div class="nav-item">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>Soutien Psychologique</span>
                </div>
                <div class="nav-item">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"/>
                    </svg>
                    <span>Communauté</span>
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
                    <h1>Bienvenue, <?php echo htmlspecialchars($_SESSION['fullname']); ?>! 👋</h1>
                    <p>Continue ton excellent travail</p>
                </div>
                <div class="user-actions">
                    <button class="notification-btn">
                        🔔
                        <span class="notification-badge">5</span>
                    </button>
                    <div class="user-profile">
                        <div class="avatar">YB</div>
                        <span><?php echo htmlspecialchars($_SESSION['fullname']); ?></span>
                    </div>
                </div>
            </header>

            <div class="support-banner">
                <div class="support-banner-icon">💜</div>
                <div class="support-banner-content">
                    <h3>Besoin d'aide ou de soutien?</h3>
                    <p>Notre équipe et nos psychologues sont là pour toi 24/7</p>
                </div>
                <button class="btn-support">Contacter</button>
            </div>

            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-info">
                        <h3>8</h3>
                        <p>Cours gratuits actifs</p>
                    </div>
                    <div class="stat-icon blue">📚</div>
                </div>
                <div class="stat-card">
                    <div class="stat-info">
                        <h3>92%</h3>
                        <p>Taux de réussite</p>
                    </div>
                    <div class="stat-icon green">✓</div>
                </div>
                <div class="stat-card">
                    <div class="stat-info">
                        <h3>15h</h3>
                        <p>Temps d'étude cette semaine</p>
                    </div>
                    <div class="stat-icon purple">⏱</div>
                </div>
            </div>

            <div class="content-grid">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Mes Cours</h2>
                        <a href="#" class="view-all">Voir tout →</a>
                    </div>
                    
                    <div class="course-item">
                        <div class="course-thumbnail">🧮</div>
                        <div class="course-info">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <h4>Mathématiques - Algèbre</h4>
                                <span class="badge-free">GRATUIT</span>
                            </div>
                            <div class="course-meta">
                                <span>📖 Chapitre 5/12</span>
                                <span>👨‍🏫 Prof. Bennani</span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 70%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="course-item">
                        <div class="course-thumbnail">🔬</div>
                        <div class="course-info">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <h4>Physique - Mécanique</h4>
                                <span class="badge-free">GRATUIT</span>
                            </div>
                            <div class="course-meta">
                                <span>📖 Chapitre 4/10</span>
                                <span>👨‍🏫 Prof. Alami</span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 50%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="course-item">
                        <div class="course-thumbnail">🌍</div>
                        <div class="course-info">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <h4>Français - Littérature</h4>
                                <span class="badge-free">GRATUIT</span>
                            </div>
                            <div class="course-meta">
                                <span>📖 Chapitre 9/12</span>
                                <span>👩‍🏫 Prof. Mansouri</span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 85%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Mon Équipe de Soutien</h2>
                    </div>

                    <div class="mentor-item">
                        <div class="mentor-avatar">MB</div>
                        <div class="mentor-info">
                            <h4>Mohamed Bennani</h4>
                            <p>Mentor Mathématiques</p>
                        </div>
                        <button class="btn btn-primary">Message</button>
                    </div>

                    <div class="mentor-item">
                        <div class="mentor-avatar">FZ</div>
                        <div class="mentor-info">
                            <h4>Fatima Zahra</h4>
                            <p>Bénévole - Soutien scolaire</p>
                        </div>
                        <button class="btn btn-primary">Message</button>
                    </div>

                    <div class="mentor-item">
                        <div class="mentor-avatar">SK</div>
                        <div class="mentor-info">
                            <h4>Dr. Sarah Karim</h4>
                            <p>Psychologue</p>
                        </div>
                        <button class="btn btn-primary">Prendre RDV</button>
                    </div>
                </div>

                <div class="card full-width">
                    <div class="card-header">
                        <h2 class="card-title">Ressources Gratuites Recommandées</h2>
                        <a href="#" class="view-all">Voir toutes →</a>
                    </div>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1rem;">
                        <div class="resource-item">
                            <div class="resource-icon">📄</div>
                            <div class="resource-info">
                                <h4>Guide de révision Bac 2025</h4>
                                <p>PDF • Toutes les matières</p>
                            </div>
                            <button class="btn btn-primary">Télécharger</button>
                        </div>

                        <div class="resource-item">
                            <div class="resource-icon">🎥</div>
                            <div class="resource-info">
                                <h4>Vidéos d'orientation</h4>
                                <p>Série • Choix de carrière</p>
                            </div>
                            <button class="btn btn-primary">Regarder</button>
                        </div>

                        <div class="resource-item">
                            <div class="resource-icon">📚</div>
                            <div class="resource-info">
                                <h4>Exercices corrigés</h4>
                                <p>PDF • Maths & Sciences</p>
                            </div>
                            <button class="btn btn-primary">Accéder</button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>