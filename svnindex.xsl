<?xml version="1.0"?>

<!-- A sample XML transformation style sheet for displaying the Subversion
  directory listing that is generated by mod_dav_svn when the "SVNIndexXSLT"
  directive is used. -->
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">

  <xsl:output method="html"/>

  <xsl:template match="*"/>

  <xsl:template match="svn">
    <html>
      <head>
        <link rel="icon" href="/favicon.ico" type="image/x-icon" />
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
        <title>
          <xsl:if test="string-length(index/@name) != 0">
            <xsl:value-of select="index/@name"/>
            <xsl:text>: </xsl:text>
          </xsl:if>
          <xsl:value-of select="index/@path"/>
        </title>
        <link rel="stylesheet" type="text/css" href="/svnindex.css"/>
      </head>
      <body>
        <div class="header">
          <xsl:element name="a">
            <xsl:attribute name="href">
              <xsl:text>http://www.visualsvn.com/server/doc/</xsl:text>
            </xsl:attribute>
            <xsl:text>Help</xsl:text>
          </xsl:element>
        </div>
        <div class="svn">
          <xsl:apply-templates/>
        </div>
        <div class="footer">
          <xsl:element name="a">
            <xsl:attribute name="href">
              <xsl:text>http://www.visualsvn.com/server/</xsl:text>
            </xsl:attribute>
            <xsl:text>VisualSVN Server</xsl:text>
          </xsl:element>
          <xsl:text> powered by </xsl:text>
          <xsl:element name="a">
            <xsl:attribute name="href">
              <xsl:value-of select="@href"/>
            </xsl:attribute>
            <xsl:text>Subversion</xsl:text>
          </xsl:element>
        </div>
      </body>
    </html>
  </xsl:template>

  <xsl:template match="index">
    <div class="rev">
      <xsl:value-of select="@name"/>
      <xsl:if test="@base">
        <xsl:if test="@name">
          <xsl:text>:&#xA0; </xsl:text>
        </xsl:if>
        <xsl:value-of select="@base" />
      </xsl:if>
      <xsl:if test="@rev">
        <xsl:if test="@base | @name">
          <xsl:text> &#x2014; </xsl:text>
        </xsl:if>
        <xsl:text>Revision </xsl:text>
        <xsl:value-of select="@rev"/>
      </xsl:if>
      <xsl:text>: </xsl:text>
      <xsl:value-of select="@path"/>
    </div>
    <xsl:apply-templates select="updir"/>
    <xsl:apply-templates select="dir"/>
    <xsl:apply-templates select="file"/>
  </xsl:template>

  <xsl:template match="updir">
    <div class="dir">
      <xsl:element name="a">
        <xsl:attribute name="href">..</xsl:attribute>

        <img src="/dir.png"/>
        <xsl:text>&#160;</xsl:text>
        <xsl:text>..</xsl:text>

      </xsl:element>
    </div>
  </xsl:template>

  <xsl:template match="dir">
    <div class="dir">
      <xsl:element name="a">
        <xsl:attribute name="href">
          <xsl:value-of select="@href"/>
        </xsl:attribute>

        <img src="/dir.png"/>
        <xsl:text>&#160;</xsl:text>
        <xsl:value-of select="@name"/>

        <xsl:text>/</xsl:text>
      </xsl:element>
    </div>
  </xsl:template>

  <xsl:template match="file">
    <div class="file">
      <xsl:element name="a">
        <xsl:attribute name="href">
          <xsl:value-of select="@href"/>
        </xsl:attribute>

        <img src="/file.png"/>
        <xsl:text>&#160;</xsl:text>
        <xsl:value-of select="@name"/>

      </xsl:element>
    </div>
  </xsl:template>

</xsl:stylesheet>
