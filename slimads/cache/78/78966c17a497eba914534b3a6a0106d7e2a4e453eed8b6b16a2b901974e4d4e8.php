<?php

/* index.html.twig */
class __TwigTemplate_8eb61fe81febbf328c97e691b381d0c25939bf707b8ddfb79d650fafafec9e64 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("master.html.twig", "index.html.twig", 1);
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
        echo "All ads";
    }

    // line 5
    public function block_content($context, array $blocks = array())
    {
        // line 6
        echo "<a href=\"/postadform\">Post ad</a><br><br>

";
        // line 8
        if ((isset($context["adList"]) ? $context["adList"] : null)) {
            // line 9
            echo "    <table border=\"1\">
        <tr>
            <th>ID</th>
            <th>Message</th>
            <th>Price</th>
            <th>Contact email</th>
            <th></th>
        </tr>
        ";
            // line 17
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["adList"]) ? $context["adList"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["ad"]) {
                // line 18
                echo "            <tr>
                <td>";
                // line 19
                echo twig_escape_filter($this->env, $this->getAttribute($context["ad"], "ID", array()), "html", null, true);
                echo "</td>
                <td>";
                // line 20
                echo twig_escape_filter($this->env, $this->getAttribute($context["ad"], "msg", array()), "html", null, true);
                echo "</td>
                <td>";
                // line 21
                echo twig_escape_filter($this->env, $this->getAttribute($context["ad"], "price", array()), "html", null, true);
                echo "</td>
                <td>";
                // line 22
                echo twig_escape_filter($this->env, $this->getAttribute($context["ad"], "contactEmail", array()), "html", null, true);
                echo "</td>
                <td width=\"55\"><a href=\"/postadform/";
                // line 23
                echo twig_escape_filter($this->env, $this->getAttribute($context["ad"], "ID", array()), "html", null, true);
                echo "\">Edit ad</td>
            </tr>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['ad'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 25
            echo "            
    </table> 
<br>
";
        } else {
            // line 29
            echo "    No ads have been found.
";
        }
        // line 31
        echo "
";
    }

    public function getTemplateName()
    {
        return "index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  96 => 31,  92 => 29,  86 => 25,  77 => 23,  73 => 22,  69 => 21,  65 => 20,  61 => 19,  58 => 18,  54 => 17,  44 => 9,  42 => 8,  38 => 6,  35 => 5,  29 => 3,  11 => 1,);
    }

    public function getSource()
    {
        return "{% extends \"master.html.twig\" %}

{% block title %}All ads{% endblock %}

{% block content %}
<a href=\"/postadform\">Post ad</a><br><br>

{% if adList %}
    <table border=\"1\">
        <tr>
            <th>ID</th>
            <th>Message</th>
            <th>Price</th>
            <th>Contact email</th>
            <th></th>
        </tr>
        {% for ad in adList %}
            <tr>
                <td>{{ad.ID}}</td>
                <td>{{ad.msg}}</td>
                <td>{{ad.price}}</td>
                <td>{{ad.contactEmail}}</td>
                <td width=\"55\"><a href=\"/postadform/{{ad.ID}}\">Edit ad</td>
            </tr>
        {% endfor %}            
    </table> 
<br>
{% else %}
    No ads have been found.
{% endif %}

{% endblock %}
";
    }
}
