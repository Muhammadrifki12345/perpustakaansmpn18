<svg {{ $attributes }} viewBox="0 0 120 120" xmlns="http://www.w3.org/2000/svg">
    <!-- Pentagon Shield -->
    <path d="M60 5 L115 45 L100 105 L20 105 L5 45 Z" fill="#38BDF8" stroke="#0C4A6E" stroke-width="2.5" />
    
    <!-- Darker Blue Inner Border -->
    <path d="M60 10 L110 47 L97 100 L23 100 L10 47 Z" fill="none" stroke="#0C4A6E" stroke-width="1" opacity="0.3" />

    <!-- Golden Star at the Top -->
    <path d="M60 12 L64 24 L76 24 L67 32 L70 44 L60 36 L50 44 L53 32 L44 24 L56 24 Z" fill="#FACC15" stroke="#92400E" stroke-width="0.5" />
    
    <!-- Laurel Wreath (Simple Paths) -->
    <g fill="none" stroke="white" stroke-width="1.5" stroke-linecap="round">
        <!-- Left Side -->
        <path d="M45 45 C35 50 30 65 48 85" opacity="0.7" />
        <path d="M38 52 L42 50" stroke-width="2" />
        <path d="M35 60 L40 58" stroke-width="2" />
        <path d="M36 68 L41 66" stroke-width="2" />
        <path d="M39 76 L44 74" stroke-width="2" />
        
        <!-- Right Side -->
        <path d="M75 45 C85 50 90 65 72 85" opacity="0.7" />
        <path d="M82 52 L78 50" stroke-width="2" />
        <path d="M85 60 L80 58" stroke-width="2" />
        <path d="M84 68 L79 66" stroke-width="2" />
        <path d="M81 76 L76 74" stroke-width="2" />
    </g>

    <!-- Torch and Book in the Center -->
    <g transform="translate(60, 55)">
        <!-- Book Background -->
        <path d="M-15 -5 Q-15 -10 0 -5 Q15 -10 15 -5 L15 10 Q0 15 -15 10 Z" fill="white" stroke="#0C4A6E" stroke-width="0.7" />
        <line x1="0" y1="-5" x2="0" y2="15" stroke="#0C4A6E" stroke-width="0.5" />
        
        <!-- Torch Handle -->
        <path d="M-4 15 L4 15 L2 35 L-2 35 Z" fill="#F59E0B" stroke="#92400E" stroke-width="0.5" />
        <!-- Torch Top -->
        <path d="M-6 12 L6 12 L5 16 L-5 16 Z" fill="#F59E0B" stroke="#92400E" stroke-width="0.5" />
        <!-- Flame -->
        <path d="M0 12 C-8 5 0 -10 0 -10 C0 -10 8 5 0 12 Z" fill="#EF4444">
            <animate attributeName="fill" values="#EF4444;#F97316;#EF4444" dur="2s" repeatCount="indefinite" />
        </path>
        <path d="M0 12 C-5 8 0 0 0 0 C0 0 5 8 0 12 Z" fill="#FACC15" />
    </g>

    <!-- The "18" Number -->
    <text x="60" y="88" text-anchor="middle" font-family="Arial, sans-serif" font-size="28" font-weight="900" fill="white" stroke="#0C4A6E" stroke-width="1" style="paint-order: stroke;">18</text>

    <!-- Logo Typography -->
    <g font-family="Arial, sans-serif" font-weight="900" fill="white" text-anchor="middle">
        <!-- Curved text would be better, but simplified for clean SVG -->
        <text x="60" y="42" font-size="8">SMP NEGERI 18</text>
        <text x="60" y="103" font-size="9">SURABAYA</text>
        <text x="60" y="112" font-size="4" font-weight="bold">EST. 1980</text>
    </g>
</svg>
