// Attendre que le DOM soit chargé
document.addEventListener("DOMContentLoaded", () => {
  // ===== NAVIGATION STICKY =====
  const navbar = document.getElementById("navbar")
  const hamburger = document.querySelector(".hamburger")
  const navMenu = document.querySelector(".nav-menu")

  // Effet sticky de la navbar
  window.addEventListener("scroll", () => {
    if (window.scrollY > 50) {
      navbar.classList.add("scrolled")
    } else {
      navbar.classList.remove("scrolled")
    }
  })

  // Menu hamburger pour mobile
  hamburger.addEventListener("click", () => {
    navMenu.classList.toggle("active")
    hamburger.classList.toggle("active")
  })

  // Fermer le menu mobile lors du clic sur un lien
  document.querySelectorAll(".nav-link").forEach((link) => {
    link.addEventListener("click", () => {
      navMenu.classList.remove("active")
      hamburger.classList.remove("active")
    })
  })

  // ===== PARTICULES ANIMÉES =====
  function createParticles() {
    const container = document.getElementById("particles-container")
    const particleCount = 50

    for (let i = 0; i < particleCount; i++) {
      const particle = document.createElement("div")
      particle.className = "particle"

      // Taille aléatoire
      const size = Math.random() * 6 + 2
      particle.style.width = size + "px"
      particle.style.height = size + "px"

      // Position aléatoire
      particle.style.left = Math.random() * 100 + "%"
      particle.style.top = Math.random() * 100 + "%"

      // Durée d'animation aléatoire
      particle.style.animationDuration = Math.random() * 3 + 3 + "s"
      particle.style.animationDelay = Math.random() * 2 + "s"

      container.appendChild(particle)
    }
  }

  // ===== ANIMATIONS AU SCROLL =====
  function animateOnScroll() {
    const elements = document.querySelectorAll(".fade-in")

    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            entry.target.classList.add("visible")
          }
        })
      },
      {
        threshold: 0.1,
        rootMargin: "0px 0px -50px 0px",
      },
    )

    elements.forEach((element) => {
      observer.observe(element)
    })
  }

  // ===== COMPTEURS ANIMÉS =====
  function animateCounters() {
    const counters = document.querySelectorAll(".stat-number")

    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            const counter = entry.target
            const target = Number.parseInt(counter.getAttribute("data-target"))
            const duration = 2000 // 2 secondes
            const increment = target / (duration / 16) // 60 FPS
            let current = 0

            const updateCounter = () => {
              current += increment
              if (current < target) {
                counter.textContent = Math.floor(current)
                requestAnimationFrame(updateCounter)
              } else {
                counter.textContent = target
              }
            }

            updateCounter()
            observer.unobserve(counter)
          }
        })
      },
      { threshold: 0.5 },
    )

    counters.forEach((counter) => {
      observer.observe(counter)
    })
  }

  // ===== EFFET RIPPLE SUR LES BOUTONS =====
  function addRippleEffect() {
    const buttons = document.querySelectorAll(".btn-primary")

    buttons.forEach((button) => {
      button.addEventListener("click", function (e) {
        const ripple = this.querySelector(".btn-ripple")
        if (ripple) {
          const rect = this.getBoundingClientRect()
          const size = Math.max(rect.width, rect.height)
          const x = e.clientX - rect.left - size / 2
          const y = e.clientY - rect.top - size / 2

          ripple.style.width = ripple.style.height = size + "px"
          ripple.style.left = x + "px"
          ripple.style.top = y + "px"

          ripple.classList.add("animate")

          setTimeout(() => {
            ripple.classList.remove("animate")
          }, 600)
        }
      })
    })
  }

  // ===== PARALLAX LÉGER =====
  function addParallaxEffect() {
    window.addEventListener("scroll", () => {
      const scrolled = window.pageYOffset
      const parallaxElements = document.querySelectorAll(".floating-card")

      parallaxElements.forEach((element) => {
        const speed = 0.5
        element.style.transform = `translateY(${scrolled * speed}px)`
      })
    })
  }

  // ===== SMOOTH SCROLL POUR LES ANCRES =====
  function initSmoothScroll() {
    document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
      anchor.addEventListener("click", function (e) {
        e.preventDefault()
        const target = document.querySelector(this.getAttribute("href"))
        if (target) {
          const offsetTop = target.offsetTop - 70 // Hauteur de la navbar
          window.scrollTo({
            top: offsetTop,
            behavior: "smooth",
          })
        }
      })
    })
  }

  // ===== ANIMATION DES CARTES AU HOVER =====
  function addCardHoverEffects() {
    const cards = document.querySelectorAll(".feature-card, .testimonial-card")

    cards.forEach((card) => {
      card.addEventListener("mouseenter", function () {
        this.style.transform = "translateY(-10px) scale(1.02)"
      })

      card.addEventListener("mouseleave", function () {
        this.style.transform = "translateY(0) scale(1)"
      })
    })
  }

  // ===== GESTION DU BOUTON DÉCOUVRIR =====
  function initDiscoverButton() {
    const discoverBtn = document.getElementById("discover-btn")
    if (discoverBtn) {
      discoverBtn.addEventListener("click", () => {
        const aboutSection = document.getElementById("apropos")
        if (aboutSection) {
          aboutSection.scrollIntoView({
            behavior: "smooth",
            block: "start",
          })
        }
      })
    }
  }

  // ===== ANIMATION DE TYPING POUR LE TITRE =====
  function addTypingAnimation() {
    const titleLines = document.querySelectorAll(".hero-title-line")

    titleLines.forEach((line, index) => {
      line.style.opacity = "0"
      line.style.transform = "translateY(30px)"

      setTimeout(
        () => {
          line.style.transition = "all 0.8s ease-out"
          line.style.opacity = "1"
          line.style.transform = "translateY(0)"
        },
        index * 300 + 500,
      )
    })
  }

  // ===== GESTION DE LA PERFORMANCE =====
  function optimizePerformance() {
    // Lazy loading pour les images si nécessaire
    if ("IntersectionObserver" in window) {
      const images = document.querySelectorAll("img[data-src]")
      const imageObserver = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            const img = entry.target
            img.src = img.dataset.src
            img.classList.remove("lazy")
            imageObserver.unobserve(img)
          }
        })
      })

      images.forEach((img) => imageObserver.observe(img))
    }

    // Throttle pour les événements de scroll
    let ticking = false
    function updateOnScroll() {
      if (!ticking) {
        requestAnimationFrame(() => {
          // Ici on peut ajouter d'autres animations liées au scroll
          ticking = false
        })
        ticking = true
      }
    }

    window.addEventListener("scroll", updateOnScroll)
  }

  // ===== INITIALISATION =====
  function init() {
    createParticles()
    animateOnScroll()
    animateCounters()
    addRippleEffect()
    addParallaxEffect()
    initSmoothScroll()
    addCardHoverEffects()
    initDiscoverButton()
    addTypingAnimation()
    optimizePerformance()

    // Animation d'entrée pour la page
    document.body.style.opacity = "0"
    setTimeout(() => {
      document.body.style.transition = "opacity 0.5s ease-in"
      document.body.style.opacity = "1"
    }, 100)
  }

  // Lancer l'initialisation
  init()

  // ===== GESTION DES ERREURS =====
  window.addEventListener("error", (e) => {
    console.log("Erreur détectée:", e.error)
    // En production, on pourrait envoyer l'erreur à un service de monitoring
  })

  // ===== ACCESSIBILITÉ =====
  // Gestion du focus pour l'accessibilité
  document.addEventListener("keydown", (e) => {
    if (e.key === "Tab") {
      document.body.classList.add("keyboard-navigation")
    }
  })

  document.addEventListener("mousedown", () => {
    document.body.classList.remove("keyboard-navigation")
  })

  // ===== PRÉFÉRENCES UTILISATEUR =====
  // Respect des préférences de mouvement réduit
  if (window.matchMedia("(prefers-reduced-motion: reduce)").matches) {
    document.documentElement.style.setProperty("--transition", "none")
    // Désactiver les animations pour les utilisateurs qui préfèrent moins de mouvement
  }

  console.log("🎉 Natfwa9 - Page d'accueil chargée avec succès!")
})

// ===== FONCTIONS UTILITAIRES =====
// Fonction pour débouncer les événements
function debounce(func, wait) {
  let timeout
  return function executedFunction(...args) {
    const later = () => {
      clearTimeout(timeout)
      func(...args)
    }
    clearTimeout(timeout)
    timeout = setTimeout(later, wait)
  }
}

// Fonction pour throttler les événements
function throttle(func, limit) {
  let inThrottle
  return function () {
    const args = arguments
    
    if (!inThrottle) {
      func.apply(this, args)
      inThrottle = true
      setTimeout(() => (inThrottle = false), limit)
    }
  }
}

// Fonction pour détecter si un élément est visible
function isElementInViewport(el) {
  const rect = el.getBoundingClientRect()
  return (
    rect.top >= 0 &&
    rect.left >= 0 &&
    rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
    rect.right <= (window.innerWidth || document.documentElement.clientWidth)
  )
}
