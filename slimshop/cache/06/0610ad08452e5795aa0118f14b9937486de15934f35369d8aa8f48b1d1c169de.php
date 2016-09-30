<?php

/* index.html.twig */
class __TwigTemplate_4b1c347fcd5bc39914cbfb385266dacc49fc9552f6154c7c8b8eeb06eaa3b7c0 extends Twig_Template
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
        echo "All products";
    }

    // line 5
    public function block_content($context, array $blocks = array())
    {
        // line 6
        echo "<a href=\"/addproduct\">Add product</a>&nbsp; &nbsp; 
<a href=\"/register\">Register</a>&nbsp; &nbsp; 
<a href=\"/login\">Login</a>
<br><br>

";
        // line 11
        if ((isset($context["sessionUser"]) ? $context["sessionUser"] : null)) {
            // line 12
            echo twig_escape_filter($this->env, (isset($context["name"]) ? $context["name"] : null), "html", null, true);
            echo "
";
        }
        // line 14
        echo "
";
        // line 15
        if ((isset($context["productList"]) ? $context["productList"] : null)) {
            // line 16
            echo "    <table border=\"1\">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Image</th>
            <th>Price</th>
        </tr>
        ";
            // line 24
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["productList"]) ? $context["productList"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["products"]) {
                // line 25
                echo "            <tr>
                <td>";
                // line 26
                echo twig_escape_filter($this->env, $this->getAttribute($context["products"], "ID", array()), "html", null, true);
                echo "</td>
                <td>";
                // line 27
                echo twig_escape_filter($this->env, $this->getAttribute($context["products"], "name", array()), "html", null, true);
                echo "</td>
                <td>";
                // line 28
                echo twig_escape_filter($this->env, $this->getAttribute($context["products"], "description", array()), "html", null, true);
                echo "</td>
                <td>";
                // line 29
                echo twig_escape_filter($this->env, $this->getAttribute($context["products"], "imagePath", array()), "html", null, true);
                echo "</td>
                <td>";
                // line 30
                echo twig_escape_filter($this->env, $this->getAttribute($context["products"], "price", array()), "html", null, true);
                echo "</td>               
            </tr>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['products'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 32
            echo "            
    </table> 
<br><br>
";
        } else {
            // line 36
            echo "    No products have been found.
";
        }
        // line 38
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
        return array (  109 => 38,  105 => 36,  99 => 32,  90 => 30,  86 => 29,  82 => 28,  78 => 27,  74 => 26,  71 => 25,  67 => 24,  57 => 16,  55 => 15,  52 => 14,  47 => 12,  45 => 11,  38 => 6,  35 => 5,  29 => 3,  11 => 1,);
    }

    public function getSource()
    {
        return "{% extends \"master.html.twig\" %}

{% block title %}All products{% endblock %}

{% block content %}
<a href=\"/addproduct\">Add product</a>&nbsp; &nbsp; 
<a href=\"/register\">Register</a>&nbsp; &nbsp; 
<a href=\"/login\">Login</a>
<br><br>

{% if sessionUser %}
{{name}}
{% endif %}

{% if productList %}
    <table border=\"1\">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Image</th>
            <th>Price</th>
        </tr>
        {% for products in productList %}
            <tr>
                <td>{{products.ID}}</td>
                <td>{{products.name}}</td>
                <td>{{products.description}}</td>
                <td>{{products.imagePath}}</td>
                <td>{{products.price}}</td>               
            </tr>
        {% endfor %}            
    </table> 
<br><br>
{% else %}
    No products have been found.
{% endif %}

{% endblock %}
";
    }
}
