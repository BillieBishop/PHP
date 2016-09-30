<?php

/* index.html.twig */
class __TwigTemplate_d38179ec8b9c89fdeab56cb6dd6ebb1d87529a428d6749d50e77ea11affb340e extends Twig_Template
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
        echo "Bookings";
    }

    // line 5
    public function block_content($context, array $blocks = array())
    {
        // line 6
        if ((isset($context["sessionUser"]) ? $context["sessionUser"] : null)) {
            // line 7
            echo "<p>Hi ";
            echo twig_escape_filter($this->env, (isset($context["name"]) ? $context["name"] : null), "html", null, true);
            echo " (";
            echo twig_escape_filter($this->env, (isset($context["passport"]) ? $context["passport"] : null), "html", null, true);
            echo ")
";
        } else {
            // line 9
            echo "<a href=\"/register\">Register</a>&nbsp; &nbsp; 
<a href=\"/login\">Login</a>
";
        }
        // line 12
        echo "
";
        // line 13
        if ((isset($context["bookingList"]) ? $context["bookingList"] : null)) {
            // line 14
            echo "    <table border=\"1\">
        <tr>
            <th>ID</th>      
            <th>From</th>
            <th>To</th>           
        </tr>
        ";
            // line 20
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["productList"]) ? $context["productList"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["products"]) {
                // line 21
                echo "            <tr>
                <td>";
                // line 22
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["bookings"]) ? $context["bookings"] : null), "ID", array()), "html", null, true);
                echo "</td>                
                <td>";
                // line 23
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["bookings"]) ? $context["bookings"] : null), "fromAirport", array()), "html", null, true);
                echo "</td>
                <td>";
                // line 24
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["bookings"]) ? $context["bookings"] : null), "toAirport", array()), "html", null, true);
                echo "</td>            
            </tr>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['products'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 26
            echo "            
    </table> 
<br><br>
";
        } else {
            // line 30
            echo "    No bookings have been found.<br>
<a href=\"/book\">Book a trip</a>
";
        }
        // line 33
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
        return array (  101 => 33,  96 => 30,  90 => 26,  81 => 24,  77 => 23,  73 => 22,  70 => 21,  66 => 20,  58 => 14,  56 => 13,  53 => 12,  48 => 9,  40 => 7,  38 => 6,  35 => 5,  29 => 3,  11 => 1,);
    }

    public function getSource()
    {
        return "{% extends \"master.html.twig\" %}

{% block title %}Bookings{% endblock %}

{% block content %}
{% if sessionUser %}
<p>Hi {{name}} ({{passport}})
{% else %}
<a href=\"/register\">Register</a>&nbsp; &nbsp; 
<a href=\"/login\">Login</a>
{% endif %}

{% if bookingList %}
    <table border=\"1\">
        <tr>
            <th>ID</th>      
            <th>From</th>
            <th>To</th>           
        </tr>
        {% for products in productList %}
            <tr>
                <td>{{bookings.ID}}</td>                
                <td>{{bookings.fromAirport}}</td>
                <td>{{bookings.toAirport}}</td>            
            </tr>
        {% endfor %}            
    </table> 
<br><br>
{% else %}
    No bookings have been found.<br>
<a href=\"/book\">Book a trip</a>
{% endif %}

{% endblock %}
";
    }
}
