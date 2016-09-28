<?php

/* postadform.html.twig */
class __TwigTemplate_8e55b034a57717fdccd8b8fe71bb5de4e015d710f2a6944fe7fa8f0d3e26af02 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("master.html.twig", "postadform.html.twig", 1);
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
        echo "Post ad";
    }

    // line 5
    public function block_content($context, array $blocks = array())
    {
        // line 6
        echo "<h1>Post ad</h1>

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
<form method=\"post\">
    Message:<br>
    <textarea rows=\"5\" cols=\"50\" name=\"msg\">";
        // line 18
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["v"]) ? $context["v"] : null), "msg", array()), "html", null, true);
        echo "</textarea><br><br>
    Price:<input type=\"text\" name=\"price\" value=\"";
        // line 19
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["v"]) ? $context["v"] : null), "price", array()), "html", null, true);
        echo "\"><br><br>
    Contact email:<input type=\"text\" name=\"contactEmail\" value=\"";
        // line 20
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["v"]) ? $context["v"] : null), "contactEmail", array()), "html", null, true);
        echo "\"><br><br>
    <input type=\"submit\" value=\"Post ad\">
</form>
";
    }

    public function getTemplateName()
    {
        return "postadform.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  77 => 20,  73 => 19,  69 => 18,  64 => 15,  60 => 13,  51 => 11,  47 => 10,  44 => 9,  42 => 8,  38 => 6,  35 => 5,  29 => 3,  11 => 1,);
    }

    public function getSource()
    {
        return "{% extends \"master.html.twig\" %}

{% block title %}Post ad{% endblock %}

{% block content %}
<h1>Post ad</h1>

{% if errorList %}
    <ul>
        {% for error in errorList %}
            <li>{{error}}</li>
            {% endfor %}
    </ul>
{% endif %}

<form method=\"post\">
    Message:<br>
    <textarea rows=\"5\" cols=\"50\" name=\"msg\">{{v.msg}}</textarea><br><br>
    Price:<input type=\"text\" name=\"price\" value=\"{{v.price}}\"><br><br>
    Contact email:<input type=\"text\" name=\"contactEmail\" value=\"{{v.contactEmail}}\"><br><br>
    <input type=\"submit\" value=\"Post ad\">
</form>
{% endblock %}
";
    }
}
