@php $cat = $category ?? 'laptop'; @endphp

@if($cat === 'laptop')
<svg viewBox="0 0 64 64" class="cat-icon"><rect x="10" y="12" width="44" height="28" rx="2"/><path d="M4 46h56l-4 6H8z"/></svg>
@elseif($cat === 'gpu')
<svg viewBox="0 0 64 64" class="cat-icon"><rect x="6" y="18" width="52" height="24" rx="2"/><circle cx="20" cy="30" r="7"/><circle cx="38" cy="30" r="7"/><rect x="6" y="44" width="14" height="6"/></svg>
@elseif($cat === 'cpu')
<svg viewBox="0 0 64 64" class="cat-icon"><rect x="18" y="18" width="28" height="28" rx="1"/><rect x="26" y="26" width="12" height="12"/><path d="M18 24H8M18 32H8M18 40H8M46 24h10M46 32h10M46 40h10M24 18V8M32 18V8M40 18V8M24 46v10M32 46v10M40 46v10"/></svg>
@elseif($cat === 'ram')
<svg viewBox="0 0 64 64" class="cat-icon"><rect x="8" y="16" width="48" height="32" rx="2"/><path d="M16 48v6M24 48v6M32 48v6M40 48v6M48 48v6"/><path d="M16 16v-4h8v4M40 16v-4h8v4"/></svg>
@elseif($cat === 'storage')
<svg viewBox="0 0 64 64" class="cat-icon"><rect x="10" y="10" width="44" height="44" rx="2"/><circle cx="32" cy="32" r="10"/><circle cx="32" cy="32" r="2.5"/><circle cx="46" cy="16" r="2"/></svg>
@elseif($cat === 'monitor')
<svg viewBox="0 0 64 64" class="cat-icon"><rect x="6" y="10" width="52" height="34" rx="2"/><path d="M26 50h12M32 44v6"/></svg>
@elseif($cat === 'keyboard')
<svg viewBox="0 0 64 64" class="cat-icon"><rect x="6" y="18" width="52" height="28" rx="2"/><path d="M14 26h4M24 26h4M34 26h4M44 26h4M14 34h4M24 34h4M34 34h4M44 34h4M18 40h28"/></svg>
@elseif($cat === 'mouse')
<svg viewBox="0 0 64 64" class="cat-icon"><rect x="22" y="10" width="20" height="44" rx="10"/><path d="M32 10v16M22 22h20"/></svg>
@elseif($cat === 'motherboard')
<svg viewBox="0 0 64 64" class="cat-icon"><rect x="8" y="8" width="48" height="48" rx="2"/><rect x="16" y="16" width="14" height="14"/><path d="M38 16h10M38 22h10M38 28h10M16 38h10M16 44h10M34 38h18v10H34z"/></svg>
@elseif($cat === 'case')
<svg viewBox="0 0 64 64" class="cat-icon"><rect x="14" y="6" width="36" height="52" rx="2"/><circle cx="32" cy="16" r="5"/><path d="M20 30h24M20 38h24M20 46h24"/></svg>
@else
<svg viewBox="0 0 64 64" class="cat-icon"><rect x="10" y="10" width="44" height="44" rx="2"/></svg>
@endif
