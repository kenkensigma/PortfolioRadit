@extends('dashboard.layout')
@section('title', 'About')
@section('breadcrumb', 'About')

@section('content')

<div class="dash-page-header">
    <div>
        <h1 class="dash-page-title">About</h1>
        <p class="dash-page-sub">Edit your bio, values, and profile details.</p>
    </div>
</div>

@if(session('success'))
    <div class="dash-flash dash-flash--success">✓ {{ session('success') }}</div>
@endif
@if($errors->any())
    <div class="dash-flash dash-flash--error">⚠ {{ $errors->first() }}</div>
@endif

<form method="POST" action="{{ route('dashboard.about.update') }}" novalidate>
    @csrf

<div class="about-editor-grid">

    {{-- Left: form --}}
    <div class="about-editor-main">

        <div class="editor-card">
            <div class="editor-card__header"><span class="editor-card__icon">◉</span><h3>Profile</h3></div>
            <div class="editor-card__body">
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="aName">Display Name</label>
                        <input class="form-input" type="text" name="name" id="aName" value="{{ old('name', $about->name) }}" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="aRole">Role / Title</label>
                        <input class="form-input" type="text" name="role" id="aRole" value="{{ old('role', $about->role) }}" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="aYears">Years Experience</label>
                        <input class="form-input" type="number" name="years_experience" id="aYears" value="{{ old('years_experience', $about->years_experience) }}" min="0" max="99" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="aProjects">Projects Delivered</label>
                        <input class="form-input" type="number" name="projects_delivered" id="aProjects" value="{{ old('projects_delivered', $about->projects_delivered) }}" min="0" required>
                    </div>
                </div>
            </div>
        </div>

        <div class="editor-card">
            <div class="editor-card__header"><span class="editor-card__icon">≡</span><h3>Bio</h3></div>
            <div class="editor-card__body">
                <div class="form-group">
                    <label class="form-label" for="aBio1">First Paragraph *</label>
                    <textarea class="form-input form-textarea" name="bio_first" id="aBio1" rows="4" required>{{ old('bio_first', $about->bio_first) }}</textarea>
                </div>
                <div class="form-group">
                    <label class="form-label" for="aBio2">Second Paragraph</label>
                    <textarea class="form-input form-textarea" name="bio_second" id="aBio2" rows="4">{{ old('bio_second', $about->bio_second) }}</textarea>
                </div>
            </div>
        </div>

        <div class="editor-card">
            <div class="editor-card__header">
                <span class="editor-card__icon">◈</span>
                <h3>Values</h3>
                <button type="button" class="editor-card__add" id="btnAddValue">+ Add Value</button>
            </div>
            <div class="editor-card__body">
                <div id="valuesList">
                    @php $values = old('values', $about->values ?? []); @endphp
                    @foreach($values as $vi => $val)
                    <div class="value-item">
                        <div class="value-item__fields">
                            <input type="text" name="values[{{ $vi }}][icon]"  placeholder="Icon (e.g. ⟳)" value="{{ $val['icon'] ?? '' }}">
                            <input type="text" name="values[{{ $vi }}][title]" placeholder="Title"           value="{{ $val['title'] ?? '' }}">
                            <input type="text" name="values[{{ $vi }}][desc]"  placeholder="Short description" value="{{ $val['desc'] ?? '' }}">
                        </div>
                        <button type="button" class="value-item__remove" onclick="this.closest('.value-item').remove()">✕</button>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="editor-card">
            <div class="editor-card__header"><span class="editor-card__icon">⟨⟩</span><h3>Hero & Contact</h3></div>
            <div class="editor-card__body">
                <div class="form-group">
                    <label class="form-label" for="aHeroSubtitle">Hero Subtitle</label>
                    <input class="form-input" type="text" name="hero_subtitle" id="aHeroSubtitle" value="{{ old('hero_subtitle', $about->hero_subtitle) }}">
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="aEmail">Email</label>
                        <input class="form-input" type="email" name="email" id="aEmail" value="{{ old('email', $about->email) }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="aGithub">GitHub URL</label>
                        <input class="form-input" type="url" name="github_url" id="aGithub" value="{{ old('github_url', $about->github_url) }}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label" for="aLinkedin">LinkedIn URL</label>
                    <input class="form-input" type="url" name="linkedin_url" id="aLinkedin" value="{{ old('linkedin_url', $about->linkedin_url) }}">
                </div>
            </div>
        </div>

        <div style="display:flex;justify-content:flex-end;padding-top:8px">
            <button type="submit" class="btn-primary">Save Changes</button>
        </div>

    </div>

    {{-- Right: live preview --}}
    <div class="about-editor-preview">
        <div class="preview-card">
            <div class="preview-card__header">Live Preview</div>
            <div class="preview-card__body">
                <div class="preview-avatar" id="previewMonogram">{{ strtoupper(substr($about->name, 0, 1)) }}</div>
                <div class="preview-name"   id="previewName">{{ $about->name }}</div>
                <div class="preview-role"   id="previewRole">{{ $about->role }}</div>
                <div class="preview-stats">
                    <div class="preview-stat">
                        <strong id="previewYears">{{ $about->years_experience }}+</strong>
                        <span>Years</span>
                    </div>
                    <div class="preview-stat">
                        <strong id="previewProjects">{{ $about->projects_delivered }}+</strong>
                        <span>Projects</span>
                    </div>
                </div>
                <div class="preview-bio" id="previewBio">{{ Str::limit($about->bio_first, 140) }}</div>
            </div>
        </div>
    </div>

</div>
</form>

<script>
// Live preview update
function updatePreview() {
    const get = id => document.getElementById(id)?.value || '';
    const name = get('aName');
    document.getElementById('previewMonogram').textContent  = name.charAt(0).toUpperCase() || 'S';
    document.getElementById('previewName').textContent      = name || 'Shiro Dev';
    document.getElementById('previewRole').textContent      = get('aRole') || 'Full Stack Developer';
    document.getElementById('previewYears').textContent     = (get('aYears') || '5') + '+';
    document.getElementById('previewProjects').textContent  = (get('aProjects') || '40') + '+';
    const bio = get('aBio1');
    document.getElementById('previewBio').textContent       = bio.length > 140 ? bio.substring(0,140)+'…' : bio;
}

['aName','aRole','aYears','aProjects','aBio1'].forEach(id => {
    document.getElementById(id)?.addEventListener('input', updatePreview);
});

// Dynamic values
let valueIndex = {{ count($values) }};

document.getElementById('btnAddValue').addEventListener('click', () => {
    const list = document.getElementById('valuesList');
    const row  = document.createElement('div');
    row.className = 'value-item';
    row.innerHTML = `
        <div class="value-item__fields">
            <input type="text" name="values[${valueIndex}][icon]"  placeholder="Icon (e.g. ⟳)">
            <input type="text" name="values[${valueIndex}][title]" placeholder="Title">
            <input type="text" name="values[${valueIndex}][desc]"  placeholder="Short description">
        </div>
        <button type="button" class="value-item__remove" onclick="this.closest('.value-item').remove()">✕</button>
    `;
    list.appendChild(row);
    valueIndex++;
});
</script>

@endsection
