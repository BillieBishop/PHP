<?php

/* index.html.twig */
class __TwigTemplate_8eb61fe81febbf328c97e691b381d0c25939bf707b8ddfb79d650fafafec9e64 extends Twig_Template
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
        echo "<a href=\"/postadform\">Post ad</a><br><br>

";
        // line 4
        if ((isset($context["adList"]) ? $context["adList"] : null)) {
            // line 5
            echo "    <table border=\"1\">
        <tr>
            <th>ID</th>
            <th>Message</th>
            <th>Price</th>
            <th>Contact email</th>
            <th></th>
        </tr>
        ";
            // line 13
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["adList"]) ? $context["adList"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["ad"]) {
                // line 14
                echo "            <tr>
                <td>";
                // line 15
                echo twig_escape_filter($this->env, $this->getAttribute($context["ad"], "ID", array()), "html", null, true);
                echo "</td>
                <td>";
                // line 16
                echo twig_escape_filter($this->env, $this->getAttribute($context["ad"], "msg", array()), "html", null, true);
                echo "</td>
                <td>";
                // line 17
                echo twig_escape_filter($this->env, $this->getAttribute($context["ad"], "price", array()), "html", null, true);
                echo "</td>
                <td>";
                // line 18
                echo twig_escape_filter($this->env, $this->getAttribute($context["ad"], "contactEmail", array()), "html", null, true);
                echo "</td>
                <td><a href=\"/postadform/";
                // line 19
                echo twig_escape_filter($this->env, $this->getAttribute($context["ad"], "ID", array()), "html", null, true);
                echo "\">Edit ad</td>
            </tr>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['ad'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 21
            echo "            
    </table>        
";
        } else {
            // line 24
            echo "    No ads have been found.
";
        }
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
        return array (  72 => 24,  67 => 21,  58 => 19,  54 => 18,  50 => 17,  46 => 16,  42 => 15,  39 => 14,  35 => 13,  25 => 5,  23 => 4,  19 => 2,);
    }

    public function getSource()
    {
        return "{# empty Twig template #}
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
                <td><a href=\"/postadform/{{ad.ID}}\">Edit ad</td>
            </tr>
        {% endfor %}            
    </table>        
{% else %}
    No ads have been found.
{% endif %}
";
    }
}
