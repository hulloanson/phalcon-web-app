<head>
  <title>{{ title }}</title>
  {# Global CSS files #}
  {% for css_name in global_css['local'] %}
    <link href="{{ url("/css/%s.css"|format(css_name))  }}" rel="stylesheet">
  {% endfor %}
  {% for css_name in page_css['local'] %}
    <link href="{{ url("/css/%s.css"|format(css_name)) }}" rel="stylesheet">
  {% endfor %}
  {# Global JS files #}
  {% for js_name in global_js['local'] %}
    <script src="{{ url("/js/%s.js"|format(js_name)) }}"></script>
  {% endfor %}
  {% for js_name in page_js['local'] %}
    <script src="{{ url("/js/%s.js"|format(js_name)) }}"></script>
  {% endfor %}
  {% for css_url in global_css['external'] %}
    <link href="{{ css_url }}" rel="stylesheet">
  {% endfor %}
  {% for css_url in page_css['external'] %}
    <link href="{{ css_url }}" rel="stylesheet">
  {% endfor %}
  {% for js_url in global_js['external'] %}
    <script src="{{ js_url }}"></script>
  {% endfor %}
  {% for js_url in page_js['external'] %}
    <script src="{{ js_url }}"></script>
  {% endfor %}
</head>