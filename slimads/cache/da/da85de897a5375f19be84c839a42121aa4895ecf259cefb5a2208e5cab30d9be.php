<?php

/* postadform_success.html.twig */
class __TwigTemplate_501983db52671bec841993622e2664dbbb3d39805dd8b510a10efbe07f4d27bb extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 2
        echo "<p>";
        echo twig_escape_filter($this->env, (isset($context["msg"]) ? $context["msg"] : null), "html", null, true);
        echo " It's ";
        echo twig_escape_filter($this->env, (isset($context["price"]) ? $context["price"] : null), "html", null, true);
        echo "\$ and can be reached at ";
        echo twig_escape_filter($this->env, (isset($context["contactEmail"]) ? $context["contactEmail"] : null), "html", null, true);
        echo ".</p>

<a href=\"../index.php\">See ads</a><br><br>";
    }

    public function getTemplateName()
    {
        return "postadform_success.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  19 => 2,);
    }

    public function getSource()
    {
        return "{# empty Twig template #}
<p>{{msg}} It's {{price}}\$ and can be reached at {{contactEmail}}.</p>

<a href=\"../index.php\">See ads</a><br><br>";
    }
}
