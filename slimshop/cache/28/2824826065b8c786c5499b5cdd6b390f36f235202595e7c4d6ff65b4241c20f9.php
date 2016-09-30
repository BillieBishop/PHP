<?php

/* login_success.html.twig */
class __TwigTemplate_13fc61b1f19ad97870f5f012a7f7042b3fd63c866f4789a1a15524cf6a2c94f6 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("master.html.twig", "login_success.html.twig", 1);
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
        echo "Login Successful";
    }

    // line 5
    public function block_content($context, array $blocks = array())
    {
        // line 6
        echo "<a href=\"/logout\">Logout</a>&nbsp; &nbsp;    
<a href=\"/addproduct\">Add product</a>&nbsp; &nbsp; 
<a href=\"../index.php\">See products</a><br><br>
<br><br>
<h1>Welcome ";
        // line 10
        echo twig_escape_filter($this->env, (isset($context["name"]) ? $context["name"] : null), "html", null, true);
        echo ".<br></h1>
";
    }

    public function getTemplateName()
    {
        return "login_success.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  44 => 10,  38 => 6,  35 => 5,  29 => 3,  11 => 1,);
    }

    public function getSource()
    {
        return "{% extends \"master.html.twig\" %}

{% block title %}Login Successful{% endblock %}

{% block content %}
<a href=\"/logout\">Logout</a>&nbsp; &nbsp;    
<a href=\"/addproduct\">Add product</a>&nbsp; &nbsp; 
<a href=\"../index.php\">See products</a><br><br>
<br><br>
<h1>Welcome {{name}}.<br></h1>
{% endblock %}
";
    }
}
