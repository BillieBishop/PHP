<?php

/* book.html.twig */
class __TwigTemplate_1809e411c38a553ae645f1c7dbbeb0de782e3cb161e3fca18b75011a15220ca9 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("master.html.twig", "book.html.twig", 1);
        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "master.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = array())
    {
        echo "Bookings";
    }

    // line 5
    public function block_content($context, array $blocks = array())
    {
        // line 6
        echo "<h1>Bookings</h1>

";
        // line 8
        if ((isset($context["errorList"]) ? $context["errorList"] : null)) {
            // line 9
            echo "    <ul>
        ";
            // line 10
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["errorList"]) ? $context["errorList"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
                // line 11
                echo "            <li>";
                echo twig_escape_filter($this->env, $context["error"], "html", null, true);
                echo "</li>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['error'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 13
            echo "    </ul>
";
        }
        // line 15
        echo "
";
        // line 16
        if ((isset($context["sessionUser"]) ? $context["sessionUser"] : null)) {
            // line 17
            echo "<p>Hi ";
            echo twig_escape_filter($this->env, (isset($context["name"]) ? $context["name"] : null), "html", null, true);
            echo " (";
            echo twig_escape_filter($this->env, (isset($context["passport"]) ? $context["passport"] : null), "html", null, true);
            echo ").</p>
<p>You want to travel</p>
<form method=\"post\">
    From:<input type=\"text\" name=\"fromAirport\" value=\"";
            // line 20
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["v"]) ? $context["v"] : null), "from", array()), "html", null, true);
            echo "\"><br><br>
    To:<input type=\"text\" name=\"toAirport\" value=\"";
            // line 21
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["v"]) ? $context["v"] : null), "to", array()), "html", null, true);
            echo "\"><br><br>   
    <input type=\"submit\" value=\"Book\">
</form> 
";
        } else {
            // line 25
            echo "<a href=\"/register\">Register</a>&nbsp; &nbsp;     
<a href=\"/login\">Login</a> 
";
        }
    }

    public function getTemplateName()
    {
        return "book.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  89 => 25,  82 => 21,  78 => 20,  69 => 17,  67 => 16,  64 => 15,  60 => 13,  51 => 11,  47 => 10,  44 => 9,  42 => 8,  38 => 6,  35 => 5,  29 => 3,  11 => 1,);
    }

    public function getSource()
    {
        return "{% extends \"master.html.twig\" %}

{% block title %}Bookings{% endblock %}

{% block content %}
<h1>Bookings</h1>

{% if errorList %}
    <ul>
        {% for error in errorList %}
            <li>{{error}}</li>
            {% endfor %}
    </ul>
{% endif %}

{% if sessionUser %}
<p>Hi {{name}} ({{passport}}).</p>
<p>You want to travel</p>
<form method=\"post\">
    From:<input type=\"text\" name=\"fromAirport\" value=\"{{v.from}}\"><br><br>
    To:<input type=\"text\" name=\"toAirport\" value=\"{{v.to}}\"><br><br>   
    <input type=\"submit\" value=\"Book\">
</form> 
{% else %}
<a href=\"/register\">Register</a>&nbsp; &nbsp;     
<a href=\"/login\">Login</a> 
{% endif %}
{% endblock %}
";
    }
}
